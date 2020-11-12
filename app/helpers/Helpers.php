<?php

namespace App\helpers;

use App\helpers\contracts\Ihelpers;
use App\Models\Asiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Helpers implements Ihelpers
{


    
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
       $parsedRubros = array_unique( array_map(function($reg){  return [ "debeRubro" => $reg["debeRubro"], "haberRubro" => $reg["haberRubro"], "titulo" => $reg["titulo"],"id_detalle_concepto" => $reg["id_detalle_concepto"],"registros"=>[] ]; },$registros), SORT_REGULAR );
       /** AHORA PONER LOS REGISTROS ORDENADOS POR ID */
       foreach ($registros as $key => $registro) {
            foreach ($parsedRubros as $key => $rubro) {
                if( $rubro["id_detalle_concepto"] == $registro["id_detalle_concepto"] ){
                    array_push($parsedRubros[$key]["registros"],$registro);
                }
            }
        }

    }

    public function getMonthsForChart($request)
    {
        $date = Carbon::now()->toDate()->format("Y"); // tomamos el ano current
        $asientos = Asiento::where("fecha_inicio","LIKE","%$date%")->where( [
            [ "id_user","=",Auth::user()->getAuthIdentifier() ], 
            ["id_company","=",$request->cookie('company') ]
        ]  )->get()->toArray();
        //$asientosCollect = collect( $asientos );
        $mesesDelanoCorriente = [];
        foreach ($asientos as $key => $value) {
            $month = Carbon::createFromFormat("Y-m-d", $value["fecha_inicio"] )->format("M");
            array_push($mesesDelanoCorriente,["mes"=>$month,"data"=>0]);
        } // obtenemos el mes de los resultados del ano
        $mesesDelanoCorriente = array_unique( $mesesDelanoCorriente, SORT_REGULAR ); // purgamos los meses repetidos del ano
        // volveremos a recorrer el array de $asientosCollect debido a que purgamos los repetidos asi que tenemos que contar
        
        foreach ($asientos as $key => $value) {
            $month = Carbon::createFromFormat("Y-m-d", $value["fecha_inicio"] )->format("M");
            foreach ($mesesDelanoCorriente as $key => $mes) {
                if( $mes["mes"] == $month ){
                    $mesesDelanoCorriente[$key]["data"] +=1; 
                }
            }
        }
        //dd( $mesesDelanoCorriente );
        return $mesesDelanoCorriente;

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
    
    public function getAsientosFromADate( Request $request, $date= null, $anually = false)
    {
        if($date == null)
        {
            $date = Carbon::now()->toDate()->format("Y-m");
        }else{
            $date = $anually ? Carbon::createFromFormat("Y-m-d",$date)->format("Y")  : Carbon::createFromFormat("Y-m-d",$date)->format("Y-m");
        }
        return Asiento::where("fecha_inicio","LIKE","%$date%")->where( [
            [ "id_user","=",Auth::user()->getAuthIdentifier() ], 
            ["id_company","=",$request->cookie('company') ]
        ]  )->get()->toArray();
    }
}