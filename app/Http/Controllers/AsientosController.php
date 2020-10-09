<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $asiento = new Asiento($asientoNuevo);
        $asiento->save();
        $id_asiento =$asiento->id_asiento;
        return redirect("contapain/asientos/$id_asiento/registros");
    }

    public function showRegistros( $id_asiento )
    {

        $rubros = Rubro::all()->toArray();
        $rubrosParseados = [];
        $this->parseRubros($rubros,$rubrosParseados);
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
    public function show()
    {
        $userModel = new User();
        $Asientos =  $userModel->find( Auth::user()->getAuthIdentifier() )->getAsientos()->get();

            return \Inertia\Inertia::render('Contapain/Asientos',[
                "Asientos" => $Asientos,
                "statusCode" => JsonResponse::HTTP_OK
            ]);
    }


    public function Dashboard()
    {
        $rubros = Rubro::all()->toArray();
        $rubrosParseados = [];
        $this->parseRubros($rubros,$rubrosParseados);
        $asientos = $this->getAsientosFromADate();
        return \Inertia\Inertia::render('Dashboard',[
            "Asientos" => $asientos,
            "catalogo_cuentas" => $rubrosParseados,
        ]);
    }

    public function getAsientosFromADate( $date= null)
    {
        if($date == null)
        {
            $date = Carbon::now()->toDate()->format("Y-m");
        }else{
            $date = Carbon::createFromFormat("Y-m-d",$date)->format("Y-m");
        }
        return Asiento::where("fecha_inicio","LIKE","%$date%")->where("id_user", Auth::user()->getAuthIdentifier() )->get()->toArray();
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function mayorizacionAndStuff( Request $request )
    {
        $parsedRegistros= [];
        $date = null;
        if( $request->has("month") ){
            $date = $request->get("month");
        }
        $asientos = $this->getAsientosFromADate($date);
        $this->extractRegistros($asientos,$parsedRegistros);

        return \Inertia\Inertia::render('Contapain/Mayorizacion',[
            "parsedRegistros" => $parsedRegistros,
            "month" => $date
        ]);
    }

    public function extractRegistros( $asientos,&$parsedRubros )
    {
        $registros = [];
        /** extraemos los registros de los asientos */
        foreach ($asientos as $key => $registro) {
            $collectionRegistro = collect($registro);
            if( $collectionRegistro->has("registros") ){
                $registros = array_merge( $registros, $collectionRegistro->get("registros") );
            }
        }
        /** TOMAR EL ID y titulo de robro DE RUBRO */
       $parsedRubros = array_unique( array_map(function($reg){  return ["titulo" => $reg["titulo"],"id_detalle_concepto" => $reg["id_detalle_concepto"],"registros"=>[] ]; },$registros), SORT_REGULAR );
       /** AHORA PONER LOS REGISTROS ORDENADOS POR ID */
       foreach ($registros as $key => $registro) {
            foreach ($parsedRubros as $key => $rubro) {
                if( $rubro["id_detalle_concepto"] == $registro["id_detalle_concepto"] ){
                    array_push($parsedRubros[$key]["registros"],$registro);
                }
            }
        }

    }



    public function parseRubros( $rubros, &$parsedRubros, $rubroActivos = [] )
    {
        foreach ($rubros as $key => $rubro)
        {
            if( $rubro["tabla"] == "rubro" ) {
                $rubroActivos = [
                    "debe" => $rubro["debe"],
                    "haber" => $rubro["haber"]
                ];
            }
            if( array_key_exists( "sub", $rubro ) && count( $rubro["sub"] ) >= 1 ) {
                $this->parseRubros( $rubro["sub"], $parsedRubros,$rubroActivos );
            }
            unset($rubro["sub"]);
            $rubro = array_merge($rubro, $rubroActivos);
            array_push( $parsedRubros, $rubro );
        }
        $parsedRubros = array_unique( $parsedRubros, SORT_REGULAR );
    }

}
