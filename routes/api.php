<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para la entidad Usuario
Route::resource('usuarios', 'UsuariosController');

// Rutas para la entidad Conductor
Route::resource('conductores', 'ConductoresController');

// Rutas para la entidad Viaje
Route::resource('viajes', 'ViajesController');

// Rutas para la entidad Vehículo
Route::resource('vehiculos', 'VehiculosController');

// Rutas para la entidad Pago
Route::resource('pagos', 'PagosController');

// Rutas para la entidad Reseña
Route::resource('resenas', 'ResenasController');


Route::post("sesion_otp","UsuariosController@Enviar_codigo_otp");
Route::post("Login_usuario","UsuariosController@Login_usuario");
Route::post("verificar_otp","SesionesCodeController@verificar_otp");

