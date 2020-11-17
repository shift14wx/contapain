<?php
namespace App\helpers\contracts;

use Illuminate\Http\Request;

Interface Ihelpers{

public function extractRegistros( $asientos,&$parsedRubros );

public function getMonthsForChart($request);

public function parseRubros( $rubros, &$parsedRubros, $rubroActivos = [] );

public function getAsientosFromADate( Request $request, $date= null, $anually = false);

public function startsWith ($string, $startString);

}