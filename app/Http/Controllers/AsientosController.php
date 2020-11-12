<?php

namespace App\Http\Controllers;

use App\helpers\contracts\Ihelpers;
use App\Models\Asiento;
use App\Models\registro;
use App\Models\Rubro;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsientosController extends Controller
{

    private Ihelpers $helpers;

    public function __construct( Ihelpers $helper ) {
        $this->helpers = $helper;
    }

    /**
     * Display a listing of asientos fo the selected day.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $date = $request->get("day");
        // si envian una peticion sin el dia, entonces se regresara a el calendario
        if( $date == null ){
            return redirect("/contapain/asientos");
        }
        $asientos = Asiento::where("fecha_inicio","LIKE","%$date%")->where( [
            [ "id_user","=",Auth::user()->getAuthIdentifier() ], 
            ["id_company","=",$request->cookie('company') ]
        ] )->get()->toArray();
        return \Inertia\Inertia::render('Contapain/Asientos/All',[
            "selectedAsientos" => $asientos,
            "day" => $date,
            "statusCode" => JsonResponse::HTTP_OK
        ]);

    }

    public function cerrarAsiento( Request $request )
    {
        $asiento = Asiento::where("id_asiento",$request->only("id_asiento"))->update($request->only("saldo"));
        response()->json(["msg"=>"done"],JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asientoNuevo = $request->validate(
            [
                "concepto_general" => "required|string",
                "fecha_inicio" => "required|date"
            ]
        );
        $asientoNuevo["id_user"] = Auth::user()->getAuthIdentifier();
        $asientoNuevo["id_company"] = $request->cookie("company");
        $asiento = Asiento::updateOrCreate(["concepto_general" => $request->get("concepto_general") ], $asientoNuevo);
        #$asiento = new Asiento($asientoNuevo);
        #$asiento->save();
        $id_asiento =$asiento->id_asiento;
        
        if( $request->has("json") && $request->get("json") ){
            return response()->json([
                "id_asiento" => $id_asiento
            ],JsonResponse::HTTP_CREATED);
        }else{
        return redirect("contapain/asientos/$id_asiento/registros");
        }
    }

    public function showRegistros( $id_asiento )
    {

        $rubros = Rubro::all()->toArray();
        $rubrosParseados = [];
        $this->helpers->parseRubros($rubros,$rubrosParseados);
        //$rubrosParseados = collect( $rubrosParseados )->sortBy("id")->toArray();
        $asiento = Asiento::find( $id_asiento )->toArray();
        $registros = registro::where("id_asiento",$id_asiento)->get()->toArray();
        return \Inertia\Inertia::render('Contapain/Registros',[
            "id_asiento" => $id_asiento,
            "selectedRegistros" => $registros,
            "selectedAsiento" => $asiento,
            "catalogo_cuentas" => $rubrosParseados,
            "statusCode" => JsonResponse::HTTP_OK
        ]);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Request $request)
    { 
        $userModel = new User();
        $Asientos = Asiento::where( [
            [ "id_user","=",Auth::user()->getAuthIdentifier() ], 
            ["id_company","=",$request->cookie('company') ]
        ]  )->get()->toArray();
            return \Inertia\Inertia::render('Contapain/Asientos',[
                "Asientos" => $Asientos,
                "statusCode" => JsonResponse::HTTP_OK
            ]);
    }


    public function Dashboard(Request $request)
    {
        $meses = $this->helpers->getMonthsForChart($request);
        $rubros = Rubro::all()->toArray();
        $rubrosParseados = [];
        $this->helpers->parseRubros($rubros,$rubrosParseados);
        $asientos = $this->helpers->getAsientosFromADate($request);
        return \Inertia\Inertia::render('Dashboard',[
            "Asientos" => $asientos,
            "catalogo_cuentas" => $rubrosParseados,
            "meses" => $meses
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $date = $request->get("fecha_inicio");
        $statusCode = JsonResponse::HTTP_OK;
        $asiento = Asiento::find($request->get("id_asiento"));
        $foundSameName = Asiento::where([
            ["concepto_general","=",$request->get("concepto_general")],
            ["fecha_inicio","=",$date],
            ["id_user","=", Auth::user()->getAuthIdentifier()],
            [ "id_asiento", "!=", $request->get("id_asiento") ]
        ])->get()->toArray();
        if( $foundSameName ){
            $statusCode = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;
        }else{
            $asiento->concepto_general = $request->get("concepto_general");
            $asiento->save();
        }

        return response()->json([
            "asiento" => $asiento,
            "statusCode" => $statusCode
        ],JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asiento =Asiento::destroy($id);

        return response()->json([
            "msg" => "done"
        ],JsonResponse::HTTP_OK);

    }


    public function mayorizacionAndStuff( Request $request )
    {
        $parsedRegistros= [];
        $date = null;
        if( $request->has("month") ){
            $date = $request->get("month");
        }
        $asientos = $this->helpers->getAsientosFromADate($request,$date, true);
        $this->helpers->extractRegistros($asientos,$parsedRegistros);

        return \Inertia\Inertia::render('Contapain/Mayorizacion',[
            "parsedRegistros" => $parsedRegistros,
            "month" => $date
        ]);
    }

    

}
