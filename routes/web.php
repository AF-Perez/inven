<?php

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

// Ésta línea genera todas las rutas necesarias para autenticación
Auth::routes();

// Ruta home
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {

    // rutas usuarios
    Route::resource('users','UserController');
    Route::get('regular-users/ingresar','UserController@ingresar')->name('regular-users.create');
    Route::post('regular-users/ingresar','UserController@guardar')->name('regular-users.store');

    // Rutas bienes
    Route::get('/bienes', 'ControladorBienes@indice');
    Route::get('/bienes/crear', 'ControladorBienes@crear');
    Route::get('/bienes/{bien}/editar', 'ControladorBienes@editar');
    Route::get('/bienes/{bien}', 'ControladorBienes@mostrar');
    Route::post('/bienes', 'ControladorBienes@almacenar');
    Route::put('/bienes/{bien}', 'ControladorBienes@actualizar');
    Route::delete('/bienes/{bien}', 'ControladorBienes@destruir');

    // Rutas inventarios
    // Route::get('/inventarios', 'ControladorInventarios@indice');
    // Route::get('/inventarios/crear', 'ControladorInventarios@crear');
    // Route::get('/inventarios/{inventario}/editar', 'ControladorInventarios@editar');
    // Route::get('/inventarios/{inventario}', 'ControladorInventarios@mostrar');
    // Route::post('/inventarios', 'ControladorInventarios@almacenar');
    // Route::put('/inventarios/{inventario}', 'ControladorInventarios@actualizar');
    // Route::delete('/inventarios/{inventario}', 'ControladorInventarios@destruir');

    // Rutas bienes_muebles
    Route::get('/muebles', 'ControladorMuebles@indice')->name('muebles.index');
    Route::get('/muebles/crear', 'ControladorMuebles@crear')->name('muebles.create');
    Route::get('/muebles/{mueble}/editar', 'ControladorMuebles@editar')->name('muebles.edit');
    Route::get('/muebles/{mueble}', 'ControladorMuebles@mostrar')->name('muebles.show');
    Route::post('/muebles', 'ControladorMuebles@almacenar');
    Route::put('/muebles/{mueble}', 'ControladorMuebles@actualizar');
    Route::delete('/muebles/{mueble}', 'ControladorMuebles@destruir')->name('muebles.destroy');

    // Rutas bienes_recursos_tecnologicos
    Route::get('/bienes_tecnologicos', 'ControladorBienesTecnologicos@indice')->name('bienes_tecnologicos.index');
    Route::get('/bienes_tecnologicos/crear', 'ControladorBienesTecnologicos@crear')->name('bienes_tecnologicos.create');
    Route::get('/bienes_tecnologicos/{bien}/editar', 'ControladorBienesTecnologicos@editar')->name('bienes_tecnologicos.edit');
    Route::get('/bienes_tecnologicos/{bien}', 'ControladorBienesTecnologicos@mostrar')->name('bienes_tecnologicos.show');
    Route::post('/bienes_tecnologicos', 'ControladorBienesTecnologicos@almacenar');
    Route::put('/bienes_tecnologicos/{bien}', 'ControladorBienesTecnologicos@actualizar');
    Route::delete('/bienes_tecnologicos/{bien}', 'ControladorBienesTecnologicos@destruir')->name('bienes_tecnologicos.destroy');

    // Rutas bienes_items_bibliograficos
    // Route::get('/bienes_items_bibliograficos', 'ControladorBienesItemsBibliograficos@indice');
    // Route::get('/bienes_items_bibliograficos/crear', 'ControladorBienesItemsBibliograficos@crear');
    // Route::get('/bienes_items_bibliograficos/{item_biblio}/editar', 'ControladorBienesItemsBibliograficos@editar');
    // Route::get('/bienes_items_bibliograficos/{item_biblio}', 'ControladorBienesItemsBibliograficos@mostrar');
    // Route::post('/bienes_items_bibliograficos', 'ControladorBienesItemsBibliograficos@almacenar');
    // Route::put('/bienes_items_bibliograficos/{item_biblio}', 'ControladorBienesItemsBibliograficos@actualizar');
    // Route::delete('/bienes_items_bibliograficos/{item_biblio}', 'ControladorBienesItemsBibliograficos@destruir');

    // Rutas ubicaciones
    Route::get('/ubicaciones', 'ControladorUbicaciones@indice');
    Route::get('/ubicaciones/crear', 'ControladorUbicaciones@crear');
    Route::get('/ubicaciones/{ubicacion}/editar', 'ControladorUbicaciones@editar');
    Route::get('/ubicaciones/{ubicacion}', 'ControladorUbicaciones@mostrar');
    Route::post('/ubicaciones', 'ControladorUbicaciones@almacenar');
    Route::put('/ubicaciones/{ubicacion}', 'ControladorUbicaciones@actualizar');
    Route::delete('/ubicaciones/{ubicacion}', 'ControladorUbicaciones@destruir');

    // Rutas usuarios_finales
    Route::get('/usuarios_finales', 'ControladorUsuariosFinales@indice');
    Route::get('/usuarios_finales/crear', 'ControladorUsuariosFinales@crear');
    Route::get('/usuarios_finales/{usuario_final}/editar', 'ControladorUsuariosFinales@editar');
    Route::get('/usuarios_finales/{usuario_final}', 'ControladorUsuariosFinales@mostrar');
    Route::post('/usuarios_finales', 'ControladorUsuariosFinales@almacenar');
    Route::put('/usuarios_finales/{usuario_final}', 'ControladorUsuariosFinales@actualizar');
    Route::delete('/usuarios_finales/{usuario_final}', 'ControladorUsuariosFinales@destruir');

    Route::resource('asignacionesTareas', 'AsignacionesTareasController');

    Route::get('/settings', 'SettingsController@index')->name('settings');

});
