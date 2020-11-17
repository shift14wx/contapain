<?php

namespace App\Http\Controllers;

use App\helpers\contracts\Ihelpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PhpParser\Node\Stmt\Break_;

class balanceGeneralController extends Controller
{
    private Ihelpers $helpers;

    public function __construct( Ihelpers $helper ) {
        $this->helpers = $helper;
    }  
    
    public function balancegeneral( Request $request )
    {

        $parsedRegistros= [];
        $date = null;
        if( $request->has("month") ){
            $date = $request->get("month");
        }
        $asientos = $this->helpers->getAsientosFromADate($request,$date, true);
        $this->helpers->extractRegistros($asientos,$parsedRegistros);

      return \Inertia\Inertia::render("Contapain/Balance/General",[
            "parsedRegistros" => $parsedRegistros,
            "month" => $date == null ? Carbon::now()->toDate()->format("Y-m-d") : $date
        ]);   
    }

    public function estadoDeResultado( Request $request ){


        $parsedRegistros= [];
        $date = null;
        
        $asientos = $this->helpers->getAsientosFromADate($request,$date, true);
        $this->helpers->extractRegistros($asientos,$parsedRegistros);


        $registrosCollection = collect($parsedRegistros);

        $costoDeVenta = [];
        $ventas = [];
        $otrosGastos = [];
        $otrosProductos = [];
        $gastosOperativos = [];

        $registrosCollection->each(function ($registro) use ( &$ventas, &$costoDeVenta, &$otrosGastos, &$otrosProductos, &$gastosOperativos )
        {
            
            switch ($registro["id_detalle_concepto"]) {
                
                case 4103:
                 array_push($costoDeVenta, $registro);
                break;
                
                case 5101:
                    array_push($ventas, $registro);
                break;

                case 4304:
                    array_push($otrosGastos, $registro);
                break;
                case 5201:
                    array_push( $otrosProductos, $registro );
                
                default:
                    if( $this->helpers->startsWith( strval( $registro["id_detalle_concepto"] ), "42" ) ){
                        array_push( $gastosOperativos, $registro);
                    }
                break;
            }
        });
        $totalVentas = collect($ventas[0]["registros"]);
        $totalVentas = $totalVentas->reduce( function ($carry,$registroDeVenta)
            {
               if( floatval($registroDeVenta["debe"]) > 0.0 && $registroDeVenta["debeRubro"] ){
                    return $carry + $registroDeVenta["debe"];
               }else if( floatval($registroDeVenta["debe"]) > 0.0 && $registroDeVenta["debeRubro"] == 0 ){
                   return $carry - $registroDeVenta["debe"];
               } else if( floatval( $registroDeVenta["haber"] ) > 0.0 && $registroDeVenta["haberRubro"] ){
                    return $carry + $registroDeVenta["haber"];
               }else if ( floatval( $registroDeVenta["haber"] ) > 0.0 && $registroDeVenta["haberRubro"] == 0 ){
                    return $carry - $registroDeVenta["haber"];
               }
            } 
        );
        dump("total de ventas");
        dd($totalVentas);

      return \Inertia\Inertia::render("Contapain/EstadoResultado/EstadoDeResultado",[
            "parsedRegistros" => $parsedRegistros,
            "ventas" => $ventas,
            "otrosGastos" => $otrosGastos,
            "otrosProductos" => $otrosProductos,
            "gastosOperativos" => $gastosOperativos,
            "totalDeVentas" => $totalVentas
        ]);

    }

}
