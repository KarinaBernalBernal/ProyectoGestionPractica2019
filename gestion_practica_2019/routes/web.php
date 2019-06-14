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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home2', 'HomeTemplateController@index')->name('home2');


/* Rutas mantenedor usuarios */
// Rutas tipo GET
Route::get('/Usuarios/lista', 'UsuarioController@lista')->name('lista_usuarios');
Route::get('/Usuarios/editar/{id_elemento}', 'UsuarioController@editar')->name('editar_usuario');
// Route::get('/Usuarios/eliminar/{id_elemento}', 'UsuarioController@eliminar')->name('eliminar_usuario');
Route::get('/Usuarios/crear', 'RegisterController@showRegistrationForm');


//Rutas tipo POST
// Route::post('/Usuarios/crear', 'Auth\RegisterController@create')->name('crear_usuario');
Route::post('/editar/{id_elemento}', 'UsuarioController@editarUsuario')->name('editar');
Route::post('/borrar/{id_elemento}','UsuarioController@borrarUsuario')->name('borrar');

/* Rutas mantenedor perfiles */
// Rutas tipo GET

Route::get('/Perfiles/lista', 'PerfilController@lista')->name('lista_perfiles');

//Rutas tipo POST
Route::post('/borrar/{id_elemento}','PerfilController@borrarPerfil')->name('borrar');

/* Rutas mantenedor recursos */
// Rutas tipo GET

Route::get('/Recursos/lista', 'RecursoController@lista')->name('lista_recursos');

//Rutas tipo POST
Route::post('/borrar/{id_elemento}','RecursoController@borrarRecurso')->name('borrar');
