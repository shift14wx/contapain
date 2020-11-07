<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class balanceGeneralController extends Controller
{
   
    
    public function balancegeneral()
    {


      return \Inertia\Inertia::render("Contapain/Balance/General");   
    }

}
