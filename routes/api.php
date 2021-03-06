<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->group( function () {
    Route::get('/bienes', 'API\ControladorBienes@traerBienes');
    Route::get('/ubicaciones/{idUbicacion}/bienes', 'API\ControladorBienes@traerBienesPorUbicacion');
    Route::get('/logout', 'API\ControladorLogin@logout');
    Route::get('/user', 'API\ControladorLogin@user');

    Route::post('/bienes', 'API\ControladorBienes@store');

    Route::get('/misTareas', 'API\ControladorTareas@getTareas');
    Route::post('/evaluarConteo', 'API\ControladorTareas@evaluarConteo');
    Route::post('/bienes/{id}/solicitarBaja', 'API\ControladorTareas@solicitarBaja');
    Route::post('/asignacionTarea/{id}/resultadoTarea', 'API\ControladorTareas@guardarResultadoTarea');

    Route::resource('ubicaciones', 'API\UbicacionController');
});

// Route::get('/misTareas', 'API\ControladorTareas@getTareas');

// rutas no protegidas
Route::post('register', 'API\ControladorRegistro@register');
Route::post('login', 'API\ControladorLogin@login');
