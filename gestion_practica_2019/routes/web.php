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

//----------------------Etapa Solicitud----------------------
//formulario de solicitud
Route::get('/formularioSolicitud', 'SolicitudController@index')->name('formularioSolicitud');
Route::post('/agregarSolicitud', 'SolicitudController@store')->name('agregarSolicitud');

//Descripcion de etapa solicitud
Route::get('/descripcionSolicitud', 'SolicitudController@verDescripcion')->name('descripcionSolicitud');

//Evaluacion de solicitudes
Route::get('/evaluacionSolicitud', 'SolicitudController@evaluacion')->name('evaluacionSolicitud');

//modals
Route::get('/modal/evaluarSolicitudModal/{id}','SolicitudController@evaluarSolicitudModal')->name('evaluarSolicitudModal');
Route::post('/evaluacionSolicitud/evaluarSolicitud/{id}','SolicitudController@evaluarSolicitud')->name('evaluarSolicitud');

Route::get('/modal/modificarEvaluacionSolicitud/{id}','SolicitudController@modificarEvaluacionSolicitud')->name('modificarEvaluacionSolicitud');
