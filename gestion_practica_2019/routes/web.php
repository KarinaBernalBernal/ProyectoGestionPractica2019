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
Route::get('/Usuarios/crear', 'RegisterController@showRegistrationForm');


//Rutas tipo POST
// Route::post('/Usuarios/crear', 'Auth\RegisterController@create')->name('crear_usuario');
Route::post('/Usuarios/actualizar/{id_elemento}', 'UsuarioController@editarUsuario')->name('actualizar_usuario');
Route::post('/Usuarios/eliminar/{id_elemento}','UsuarioController@borrarUsuario')->name('borrar_usuario');



/* Rutas mantenedor perfiles */
// Rutas tipo GET
Route::get('/Perfiles/lista', 'PerfilController@lista')->name('lista_perfiles');
Route::get('/Perfiles/crear', 'PerfilController@crear')->name('crear_perfil');
Route::get('/Perfiles/editar/{id_elemento}', 'PerfilController@editar')->name('editar_perfil');

//Rutas tipo POST
Route::post('/Perfiles/agregar', 'PerfilController@crearPerfil')->name('agregar_perfil');
Route::post('/Perfiles/actualizar/{id_elemento}', 'PerfilController@editarPerfil')->name('actualizar_perfil');
Route::post('/Perfiles/eliminar/{id_elemento}','PerfilController@borrarPerfil')->name('borrar_perfil');



/* Rutas mantenedor recursos */
// Rutas tipo GET
Route::get('/Recursos/lista', 'RecursoController@lista')->name('lista_recursos');
Route::get('/Recursos/crear', 'RecursoController@crear')->name('crear_recurso');
Route::get('/Recursos/editar/{id_elemento}', 'RecursoController@editar')->name('editar_recurso');

//Rutas tipo POST
Route::post('/Recursos/agregar', 'RecursoController@crearRecurso')->name('agregar_recurso');
Route::post('/Recursos/actualizar/{id_elemento}', 'RecursoController@editarRecurso')->name('actualizar_recurso');
Route::post('/Recursos/eliminar/{id_elemento}','RecursoController@borrarRecurso')->name('borrar_recurso');
