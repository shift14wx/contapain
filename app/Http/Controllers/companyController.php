<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class companyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = User::find(  Auth::user()->getAuthIdentifier() )->getCompanies()->get()->toArray();
        return \Inertia\Inertia::render('Contapain/Company/All',[
            "AllCompanies" => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cookie = cookie('company', $id, 60000);
        $response = new Response('<h1 style=" text-align: center;">hecho</h1><img style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="https://i.pinimg.com/originals/3d/20/ab/3d20ab286d279f3aa920175793b54e0e.gif"> <h2 style=" text-align: center;">Sera redirigido a su pantalla de inicio, bien hecho!</h2>');

        //Call the withCookie() method with the response method
        $response->withCookie($cookie);
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCompany = $request->only("titulo","giro","direccion");

        $newCompany["id_user"] = Auth::user()->getAuthIdentifier();

        $savedCompanny = Company::create($newCompany);

        return response()->json([
            "id_company"=>$savedCompanny->id_company,
            "statusCode"=>JsonResponse::HTTP_CREATED
        ],JsonResponse::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
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
        $company = Company::find($request->get("id_company"));
        $foundSameName = Company::where([
            ["titulo","=",$request->get("titulo")],
            ["direccion","=",$request->get("direccion")],
            ["id_user","=", Auth::user()->getAuthIdentifier()],
            [ "id_company", "!=", $request->get("id_company") ]
        ])->get()->toArray();
        if( $foundSameName ){
            $statusCode = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;
        }else{
            $company->titulo = $request->get("titulo");
            $company->direccion = $request->get("direccion");
            $company->giro = $request->get("giro");
            $company->save();
        }

        return response()->json([
            "company" => $company,
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
        $company =Company::destroy($id);

        return response()->json([
            "msg" => "done"
        ],JsonResponse::HTTP_OK);
    }
}
