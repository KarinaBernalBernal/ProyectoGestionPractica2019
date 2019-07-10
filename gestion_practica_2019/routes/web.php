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

/*--------------------- Etapa Solicitud ---------------------*/
//-------formulario de solicitud
Route::get('/formularioSolicitud', 'SolicitudController@index')->name('formularioSolicitud');
Route::post('/agregarSolicitud', 'SolicitudController@store')->name('agregarSolicitud');

//--------Descripcion de etapa solicitud
Route::get('/descripcionSolicitud', 'SolicitudController@verDescripcion')->name('descripcionSolicitud');

//--------Evaluacion de solicitudes
//Civil
Route::get('/evaluacionSolicitudCivil', 'SolicitudController@evaluacion')->name('evaluacionSolicitud');
//Ejecucion
Route::get('/evaluacionSolicitudEjecucion', 'SolicitudController@evaluacionEjecucion')->name('evaluacionSolicitudEjecucion');

//modals 
Route::get('/modal/evaluarSolicitudModal/{id}','SolicitudController@evaluarSolicitudModal')->name('evaluarSolicitudModal');
Route::post('/evaluacionSolicitud/evaluarSolicitud/{id}','SolicitudController@evaluarSolicitud')->name('evaluarSolicitud');

Route::get('/modal/modificarEvaluacionSolicitudModal/{id}','SolicitudController@modificarEvaluacionSolicitudModal')->name('modificarEvaluacionSolicitudModal');
Route::post('/evaluacionSolicitud/modificarEvaluacionSolicitud/{id}','SolicitudController@modificarEvaluacionSolicitud')->name('modificarEvaluacionSolicitud');

//---------Validacion de solicitudes
Route::get('/listaSolicitudEjecucion', 'SolicitudController@listaSolicitudEjecucion')->name('listaSolicitudEjecucion');
Route::get('/listaSolicitudCivil', 'SolicitudController@listaSolicitudCivil')->name('listaSolicitudCivil');

Route::get('/borrarSolicitud/{id_solicitud}', 'SolicitudController@destroy')->name('borrarSolicitud');
Route::resource('solicitudes', 'SolicitudController');

Route::get('/aceptarSolicitud/{id_solicitud}', 'SolicitudController@estado')->name('aceptarSolicitud');
