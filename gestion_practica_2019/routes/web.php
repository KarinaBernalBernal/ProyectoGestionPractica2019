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

//Solicitudes
Route::get('/formularioSolicitud', 'SolicitudController@index')->name('formularioSolicitud');
Route::post('/agregarSolicitud', 'SolicitudController@store')->name('agregarSolicitud');
Route::get('/descripcionSolicitud', 'SolicitudController@descripcion')->name('descripcionSolicitud');
Route::get('/listaSolicitudEjecucion', 'SolicitudController@listaSolicitudEjecucion')->name('listaSolicitudEjecucion');
Route::get('/listaSolicitudCivil', 'SolicitudController@listaSolicitudCivil')->name('listaSolicitudCivil');

Route::get('/borrarSolicitud/{id_solicitud}', 'SolicitudController@destroy')->name('borrarSolicitud');
Route::resource('solicitudes', 'SolicitudController');

Route::get('/aceptarSolicitud/{id_solicitud}', 'SolicitudController@estado')->name('aceptarSolicitud');