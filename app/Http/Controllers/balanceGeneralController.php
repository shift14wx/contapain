<?php

namespace App\Http\Controllers;

use App\helpers\contracts\Ihelpers;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

      return \Inertia\Inertia::render("Contapain/EstadoResultado/EstadoDeResultado",[
            "parsedRegistros" => $parsedRegistros,
            "month" => $date == null ? Carbon::now()->toDate()->format("Y-m-d") : $date
        ]);

    }

}
