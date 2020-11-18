<?php

namespace App\Http\Controllers;

use App\helpers\contracts\Ihelpers;
use App\Models\Company;
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
        $gastosFinancieros = [];
        $gastosDeOperacion = [];
        $subOperacionGastosVentas = [];
        $subOperacionesGastosAdministracion=[];
        $subOperacionesRebajaYDevolucionesSobreVentas=[];
        $SubOperacionDescuentoSobreVentas = [];

        $registrosCollection->each(function ($registro) use ( &$ventas, &$costoDeVenta, &$otrosGastos, &$otrosProductos, &$gastosFinancieros, &$gastosDeOperacion, &$subOperacionGastosVentas, &$subOperacionesGastosAdministracion, &$subOperacionesRebajaYDevolucionesSobreVentas, &$SubOperacionDescuentoSobreVentas )
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
                case $this->helpers->startsWith($registro["id_detalle_concepto"],"4301"):
                    array_push( $gastosFinancieros, $registro );
                break;
                case 42:
                    array_push( $gastosDeOperacion, $registro );
                break;
                case $this->helpers->startsWith($registro["id_detalle_concepto"],"4201"):
                    array_push( $subOperacionesGastosAdministracion ,$registro );
                break;
                case 4202:
                    array_push( $subOperacionGastosVentas, $registro );
                break;
                case 4203:
                    array_push( $subOperacionesRebajaYDevolucionesSobreVentas, $registro );
                break;
                case 4204:
                    array_push( $SubOperacionDescuentoSobreVentas, $registro );
                break;
                
                default:
                break;
            }
        })
        ;// sacando gastos de operacion pero con sus padres e hijos para los totales y la muestra total en el estado de EstadoDeResultado
        
        $totalGastoDeOperacion =0.0;
        if( count( $gastosDeOperacion ) >0  ){
            
        $totalGastoDeOperacion = collect($gastosDeOperacion[0]["registros"]);
        $totalGastoDeOperacion = $totalGastoDeOperacion->reduce( function ($carry,$registroDeVenta)
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

        }
        $totalGastosAdministracion =0.0;
        if( count( $subOperacionesGastosAdministracion ) >0  ){
            
        $totalGastosAdministracion = collect($subOperacionesGastosAdministracion[0]["registros"]);
        $totalGastosAdministracion = $totalGastosAdministracion->reduce( function ($carry,$registroDeVenta)
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

        }

        $totalGastosDeVenta =0.0;
        if( count( $subOperacionGastosVentas ) >0  ){
            
        $totalGastosDeVenta = collect($subOperacionGastosVentas[0]["registros"]);
        $totalGastosDeVenta = $totalGastosDeVenta->reduce( function ($carry,$registroDeVenta)
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

        }

        $totalRebajaYDevolucionesSobreVenta =0.0;
        if( count( $subOperacionesRebajaYDevolucionesSobreVentas) >0  ){
            
        $totalRebajaYDevolucionesSobreVenta = collect($subOperacionesRebajaYDevolucionesSobreVentas[0]["registros"]);
        $totalRebajaYDevolucionesSobreVenta = $totalRebajaYDevolucionesSobreVenta->reduce( function ($carry,$registroDeVenta)
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

        }

        $totalDescuentoSobreVentas =0.0;
        if( count( $SubOperacionDescuentoSobreVentas ) >0  ){
            
        $totalDescuentoSobreVentas = collect($SubOperacionDescuentoSobreVentas[0]["registros"]);
        $totalDescuentoSobreVentas = $totalDescuentoSobreVentas->reduce( function ($carry,$registroDeVenta)
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

        }
        // sacando el total de ventas en lugar de hacearlo en el front-end
        $totalVentas = 0.0;
        if( count($ventas) >0 ){
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
    }
        // suma total de costo de ventas
        $totalVentascostos = 0.0;
    if( count($costoDeVenta) > 0 ){
        $totalVentascostos = collect($costoDeVenta[0]["registros"]);
        $totalVentascostos = $totalVentascostos->reduce( function ($carry,$registroDeVenta)
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
    }

    // otros gastos
        $otrosGastosTotal = 0.0;
    if( count($otrosGastos) > 0 ){
        $otrosGastosTotal = collect($otrosGastos[0]["registros"]);
        $otrosGastosTotal = $otrosGastosTotal->reduce( function ($carry,$registroDeVenta)
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
    }

     // otros productos
     $otrosProductostotal = 0.0;
     if( count($otrosProductos) > 0 ){
         $otrosProductostotal = collect($otrosProductos[0]["registros"]);
         $otrosProductostotal = $otrosProductostotal->reduce( function ($carry,$registroDeVenta)
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
     }

// tomando nombre de la compañia selecionada mediante la cookie

$company = Company::find( $request->cookie("company") )->titulo;


      return \Inertia\Inertia::render("Contapain/EstadoResultado/EstadoDeResultado",[
            "parsedRegistros" => $parsedRegistros,
            "ventas" => $ventas,
            "otrosGastos" => $otrosGastos,
            "otrosProductos" => $otrosProductos,
            "gastosOperativos" => $gastosDeOperacion,
            "totalDeVentas" => $totalVentas,
            "costosDeVentas" => abs( $costoDeVenta ),
            "totalCostosDeVentas" => abs( $totalVentascostos ),

            "gastosDeOperacion" => abs( $gastosDeOperacion ),
            "operacioGastosAdministracion" => abs( $subOperacionesGastosAdministracion ),
            "operacionGastosDeVenta" => abs( $subOperacionGastosVentas ),
            "operacionesRebajaYDevolucionesSobreVentas" => abs( $subOperacionesRebajaYDevolucionesSobreVentas),
            "operacionDescuentoSobreVentas" => abs( $SubOperacionDescuentoSobreVentas ),

            "totalGastosDeAdministracion" => abs( $totalGastosAdministracion ),
            "totalGastoDeOperacion" =>abs( $totalGastoDeOperacion ),
            "totalGastosDeVenta" => abs($totalGastosDeVenta ),
            "totalRebajayDevolucionSobreVenta" =>abs( $totalRebajaYDevolucionesSobreVenta ),
            "totalDescuentoSobreVentas" => abs($totalDescuentoSobreVentas ),


            "otrosGastosTotal" =>abs( $otrosGastosTotal ),
            "otrosProductostotal" =>abs( $otrosProductostotal ),

            "company" => $company,
            "year" => Carbon::now()->toDate()->format("Y")
        ]);

    }

}
