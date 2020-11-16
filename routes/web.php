<?php

use App\Http\Controllers\AsientosController;
use App\Http\Controllers\CatalogodeCuentasController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\registroController;

use App\Http\Controllers\balanceGeneralController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/store/catalogos', [CatalogodeCuentasController::class,"storeByJson"]);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',[ AsientosController::class, 'Dashboard' ])->middleware('companyCookie')->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/contapain/mayorizacion',[ AsientosController::class, 'mayorizacionAndStuff' ])->middleware('companyCookie')->name('mayorizacion');

Route::middleware(['auth:sanctum', 'verified'])->post('/contapain/cerrarasiento',[ AsientosController::class, 'cerrarAsiento' ])->middleware('companyCookie')->name('cerrarasiento');

// COMPANY ROUTES

Route::resource('company', App\Http\Controllers\companyController::class)->middleware(['auth:sanctum', 'verified']);

Route::middleware(['auth:sanctum', 'verified'])->get('/company/select/{id}',[ App\Http\Controllers\companyController::class,"create"]);


Route::middleware(['auth:sanctum', 'verified'])->patch('/company/',[ App\Http\Controllers\companyController::class,"update"]);

// END COMPANY ROUTES
// Route::get('/contapain/registro', [registroController::class, 'index']);

// Route::get('/contapain/registro/create', [registroController::class, 'create']);

Route::resource('registros', App\Http\Controllers\registroController::class)->middleware(['auth:sanctum', 'verified']);

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/contapain/asientos',[AsientosController::class,"show"])
    ->middleware('companyCookie')
    ->name('/contapain/asientos');

Route::middleware(['auth:sanctum', 'verified'])
    ->post('/contapain/asientos/agregar',[AsientosController::class,"store"])
    ->middleware('companyCookie')
    ->name('/contapain/asientos/agregar');

Route::middleware(['auth:sanctum', 'verified'])
->patch('/contapain/asientos',[AsientosController::class,"update"])
->middleware('companyCookie')
->name('/contapain/asientos');

Route::middleware(['auth:sanctum', 'verified'])
->delete('/contapain/asientos/{id}',[AsientosController::class,"destroy"]);

Route::middleware(['auth:sanctum', 'verified'])
->middleware('companyCookie')
->get('contapain/asientos/all',[AsientosController::class,"index"]);

Route::middleware(['auth:sanctum', 'verified'])
->middleware('companyCookie')
    ->get('contapain/asientos/{id_asiento}/registros',[AsientosController::class,"showRegistros"]);


Route::middleware(['auth:sanctum', 'verified'])
    ->get('/contapain/asientos/agregar',[AsientosController::class,"store"])
    ->middleware('companyCookie')
    ->name('/contapain/asientos/agregar');

    // Balance general y estado de resultado


Route::middleware(['auth:sanctum', 'verified'])
->middleware('companyCookie')
    ->get('/contapain/balancegeneral',[balanceGeneralController::class,"balancegeneral"]);

Route::middleware(["auth:sanctum", 'verified'])
->middleware("companyCookie")
    ->get('/contapain/estadoresultado',[ balanceGeneralController::class, "estadoDeResultado" ]);