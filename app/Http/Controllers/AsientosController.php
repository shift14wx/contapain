<?php

namespace App\Http\Controllers;

use App\Models\Asiento;
use App\Models\Registro;
use App\Models\Rubro;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $registros = Registro::where("id_asiento","=",$id_asiento)->get()->toArray();
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



    public function parseRubros( $rubros, &$parsedRubros )
    {
        foreach ($rubros as $key => $rubro)
        {
            if( array_key_exists( "sub", $rubro ) && count( $rubro["sub"] ) >= 1 ) {
                $this->parseRubros( $rubro["sub"], $parsedRubros );
            }
            unset($rubro["sub"]);
            array_push( $parsedRubros, $rubro );
        }
        $parsedRubros = array_unique( $parsedRubros, SORT_REGULAR );
    }

}
