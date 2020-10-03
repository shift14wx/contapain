<?php

use App\Http\Controllers\AsientosController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\registroController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');



Route::middleware(['auth:sanctum', 'verified'])->get('/contapain/asientos', function () {
    dd("what");
    return Inertia\Inertia::render('Contapain/Asientos');
})->name('/contapain/asientos');


// Route::get('/contapain/registro', [registroController::class, 'index']);

// Route::get('/contapain/registro/create', [registroController::class, 'create']);

Route::resource('registros', App\Http\Controllers\registroController::class);

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/contapain/asientos',[AsientosController::class,"show"])
    ->name('/contapain/asientos');



Route::middleware(['auth:sanctum', 'verified'])
    ->post('/contapain/asientos/agregar',[AsientosController::class,"store"])
    ->name('/contapain/asientos/agregar');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('contapain/asientos/{id_asiento}/registros',[AsientosController::class,"showRegistros"]);


Route::middleware(['auth:sanctum', 'verified'])
    ->get('/contapain/asientos/agregar',[AsientosController::class,"store"])
    ->name('/contapain/asientos/agregar');
