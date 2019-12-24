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
Route::get('/Usuarios/crear_usuario', 'UsuarioController@crear')->name('crear_usuario_mantenedor');

Route::get('/Usuarios/crear', 'RegisterController@showRegistrationForm');
//Rutas tipo POST
Route::post('/Usuarios/crear', 'Auth\RegisterController@create')->name('crear_usuario');
Route::post('/Usuarios/agregar', 'UsuarioController@crearUsuario')->name('agregar_usuario_mantenedor');
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
/* Rutas mantenedor alumnos */
// Rutas tipo GET
Route::get('/Alumnos/lista', 'AlumnoController@lista')->name('lista_alumnos');
Route::get('/Alumnos/crear', 'AlumnoController@crear')->name('crear_alumno');
Route::get('/Alumnos/editar/{id_elemento}', 'AlumnoController@editar')->name('editar_alumno');
//Rutas tipo POST
Route::post('/Alumnos/agregar', 'AlumnoController@crearAlumno')->name('agregar_alumno');
Route::post('/Alumnos/actualizar/{id_elemento}', 'AlumnoController@editarAlumno')->name('actualizar_alumno');
Route::post('/Alumnos/eliminar/{id_elemento}','AlumnoController@borrarAlumno')->name('borrar_alumno');
/* Rutas mantenedor administradores */
// Rutas tipo GET
Route::get('/Administradores/lista', 'AdministradorController@lista')->name('lista_administradores');
Route::get('/Administradores/crear', 'AdministradorController@crear')->name('crear_administrador');
Route::get('/Administradores/editar/{id_elemento}', 'AdministradorController@editar')->name('editar_administrador');
//Rutas tipo POST
Route::post('/Administradores/agregar', 'AdministradorController@crearAdministrador')->name('agregar_administrador');
Route::post('/Administradores/actualizar/{id_elemento}', 'AdministradorController@editarAdministrador')->name('actualizar_administrador');
Route::post('/Administradores/eliminar/{id_elemento}','AdministradorController@borrarAdministrador')->name('borrar_administrador');

/* Rutas mantenedor recursos */
// Rutas tipo GET
Route::get('/Practicas/lista', 'PracticaController@lista')->name('lista_practicas');
Route::get('/Practicas/crear', 'PracticaController@crear')->name('crear_practica');
Route::get('/Practicas/editar/{id_elemento}', 'PracticaController@editar')->name('editar_practica');
//Rutas tipo POST
Route::post('/Practicas/agregar', 'PracticaController@crearPractica')->name('agregar_practica');
Route::post('/Practicas/actualizar/{id_elemento}', 'PracticaController@editarPractica')->name('actualizar_practica');
Route::post('/Practicas/eliminar/{id_elemento}','PracticaController@borrarPractica')->name('borrar_practica');
/* Rutas mantenedor evaluacion de supervisor */
// Rutas tipo GET
Route::get('/EvaluacionesSupervisor/lista', 'EvaluacionSupervisorController@lista')->name('lista_evaluaciones_supervisor');
Route::get('/EvaluacionesSupervisor/crear', 'EvaluacionSupervisorController@crear')->name('crear_evaluacion_supervisor');
Route::get('/EvaluacionesSupervisor/editar/{id_elemento}', 'EvaluacionSupervisorController@editar')->name('editar_evaluacion_supervisor');
//Rutas tipo POST
Route::post('/EvaluacionesSupervisor/agregar', 'EvaluacionSupervisorController@crearEvaluacionSupervisor')->name('agregar_evaluacion_supervisor');
Route::post('/EvaluacionesSupervisor/actualizar/{id_elemento}', 'EvaluacionSupervisorController@editarEvaluacionSupervisor')->name('actualizar_evaluacion_supervisor');
Route::post('/EvaluacionesSupervisor/eliminar/{id_elemento}','EvaluacionSupervisorController@borrarEvaluacionSupervisor')->name('borrar_evaluacion_supervisor');
/* Rutas mantenedor de autoevaluacion */
// Rutas tipo GET
Route::get('/AutoEvaluaciones/lista', 'AutoEvaluacionController@lista')->name('lista_auto_evaluaciones');
Route::get('/AutoEvaluaciones/crear', 'AutoEvaluacionController@crear')->name('crear_auto_evaluacion');
Route::get('/AutoEvaluaciones/editar/{id_elemento}', 'AutoEvaluacionController@editar')->name('editar_auto_evaluacion');
//Rutas tipo POST
Route::post('/AutoEvaluaciones/agregar', 'AutoEvaluacionController@crearAutoEvaluacion')->name('agregar_auto_evaluacion');
Route::post('/AutoEvaluaciones/actualizar/{id_elemento}', 'AutoEvaluacionController@editarAutoEvaluacion')->name('actualizar_auto_evaluacion');
Route::post('/AutoEvaluaciones/eliminar/{id_elemento}','AutoEvaluacionController@borrarAutoEvaluacion')->name('borrar_auto_evaluacion');
/* Rutas mantenedor empresa */
// Rutas tipo GET
Route::get('/Empresas/lista', 'EmpresaController@lista')->name('lista_empresas');
Route::get('/Empresas/crear', 'EmpresaController@crear')->name('crear_empresa');
Route::get('/Empresas/editar/{id_elemento}', 'EmpresaController@editar')->name('editar_empresa');
//Rutas tipo POST
Route::post('/Empresas/agregar', 'EmpresaController@crearEmpresa')->name('agregar_empresa');
Route::post('/Empresas/actualizar/{id_elemento}', 'EmpresaController@editarEmpresa')->name('actualizar_empresa');
Route::post('/Empresas/eliminar/{id_elemento}','EmpresaController@borrarEmpresa')->name('borrar_empresa');
/* Rutas mantenedor Supervisor */
// Rutas tipo GET
Route::get('/Supervisores/lista', 'SupervisorController@lista')->name('lista_supervisores');
Route::get('/Supervisores/crear', 'SupervisorController@crear')->name('crear_supervisor');
Route::get('/Supervisores/editar/{id_elemento}', 'SupervisorController@editar')->name('editar_supervisor');
//Rutas tipo POST
Route::post('/Supervisores/agregar', 'SupervisorController@crearSupervisor')->name('agregar_supervisor');
Route::post('/Supervisores/actualizar/{id_elemento}', 'SupervisorController@editarSupervisor')->name('actualizar_supervisor');
Route::post('/Supervisores/eliminar/{id_elemento}','SupervisorController@borrarSupervisor')->name('borrar_supervisor');

/* Rutas mantenedor elementos dinamicos */
// Rutas tipo GET
Route::get('/ElementosDinamicos/crear/{tipo}', 'ElementosDinamicosController@crear')->name('crear_elemento_dinamico');
Route::get('/ElementosDinamicos/lista', 'ElementosDinamicosController@lista')->name('lista_elementos_dinamicos');
Route::get('/ElementosDinamicos/editar/{id_elemento},{tipo}', 'ElementosDinamicosController@editar')->name('editar_elemento');
//Rutas tipo POST
Route::post('/ElementosDinamicos/agregar/{tipo}', 'ElementosDinamicosController@crearElemento')->name('agregar_elemento_dinamico');
Route::post('/ElementosDinamicos/eliminar/{id_elemento},{tipo}','ElementosDinamicosController@borrarElemento')->name('borrar_elemento_dinamico');
Route::post('/ElementosDinamicos/actualizar/{id_elemento},{tipo}', 'ElementosDinamicosController@editarElemento')->name('actualizar_elemento_dinamico');
Route::post('/ElementosDinamicos/vigencia', 'ElementosDinamicosController@modificarVigencia')->name('modificar_vigencia');

/* Rutas mantenedor otros */
// Rutas tipo GET
Route::get('/Otros/crear/{tipo}', 'OtroController@crear')->name('crear_otro');
Route::get('/Otros/lista', 'OtroController@lista')->name('lista_otros');
Route::get('/Otros/editar/{id_elemento},{tipo}', 'OtroController@editar')->name('editar_otro');
//Rutas tipo POST
Route::post('/Otros/agregar/{tipo}', 'OtroController@crearElemento')->name('agregar_otro');
Route::post('/Otros/eliminar/{id_elemento},{tipo}','OtroController@borrarElemento')->name('borrar_otro');
Route::post('/Otros/actualizar/{id_elemento},{tipo}', 'OtroController@editarElemento')->name('actualizar_otro');


/*--------------------- Etapa Solicitud ---------------------*/

//-------Envio de correo para estudiante con link de formulario de autorización práctica
Route::get('/contactar', 'SolicitudController@contact')->name('contact');

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
Route::get('/solicitudesPFiltrada/{carrera}', 'SolicitudController@filtroSolicitudesP')->name('solicitudesPFiltrada');
Route::get('/solicitudesEFiltrada/{carrera}', 'SolicitudController@filtroSolicitudesE')->name('solicitudesEFiltrada');


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
/*--------------------- Etapa Inscripcion ---------------------*/
//--------Descripcion de etapa Inscripcion
//solicitudDocumentos
Route::get('/descripcionSolicitudDocumentos', 'InscripcionController@verDescripcionSolicitudDoc')->name('descripcionSolicitudDocumentos');
Route::get('/lista_solicitudes_documentos', 'InscripcionController@lista')->name('lista_solicitudes_documentos');
//formularioInscripcion
Route::get('/descripcionInscripcion', 'InscripcionController@verDescripcionInscripcion')->name('descripcionInscripcion');
//-------formulario de solicitud de documentos
Route::get('/formularioSolicitudDocumentos', 'InscripcionController@indexSolicitarDocumentos')->name('formularioSolicitarDocumentos');

Route::post('/agregarSolicitudDocumentos', 'InscripcionController@storeSolicitarDocumentos')->name('agregarSolicitudDocumentos');
//-------formularioInscripcion
Route::get('/formularioInscripcion', 'InscripcionController@indexInscripcion')->name('formularioInscripcion');
Route::post('/agregarInscripcion', 'InscripcionController@storeInscripcion')->name('agregarInscripcion');
//---------listas
Route::get('/listaInscripcion/{carrera}', 'InscripcionController@listaInscripcion')->name('listaInscripcion');
/*--------------------- Etapa Evaluación ---------------------*/
Route::get('/descripcionAutoEvaluacion', 'AutoEvaluacionController@verDescripcionAutoEvaluacion')->name('descripcionAutoEvaluacion');
Route::get('/formularioAutoEvaluacion', 'AutoEvaluacionController@index')->name('formularioAutoEvaluacion');
Route::post('/agregarAutoEvaluacion', 'AutoEvaluacionController@store')->name('agregarAutoEvaluacion');
Route::get('/descripcionEvaluacionEmpresa', 'EvaluacionSupervisorController@verDescripcionEvaluacionEmpresa')->name('descripcionEvaluacionEmpresa');
Route::get('/formularioEvaluacionEmpresa/{id}', 'EvaluacionSupervisorController@index')->name('formularioEvaluacionEmpresa');
Route::post('/agregarEvaluacionEmpresa/{id}', 'EvaluacionSupervisorController@store')->name('agregarEvaluacionEmpresa');
Route::get('/listaAutoevaluacion/{carrera}', 'AutoEvaluacionController@autoevaluacioneEjecucion')->name('listaAutoevaluacion');
Route::get('/listaEvaluacionSupervisor/{carrera}', 'EvaluacionSupervisorController@listaEvaluacionSupervisor')->name('listaEvaluacionSupervisor');

/*--------------------- Reportes ---------------------*/
/* Rutas Reportes alumnos */
// Rutas tipo GET
Route::get('/Reportes/alumnos', 'AlumnosReporteController@index')->name('reporte_alumnos');

/* ---------------------------------------  Estadísticas  ---------------------------- */
/* --------------  Estadisticas de alumno --------------- */
Route::get('/estadisticaAlumno', 'EstadisticaController@buscarAlumno')->name('estadisticaAlumno');
/* --------------  Estadisticas Generales --------------- */
//Criterios
Route::get('/estadisticaCriterios', 'EstadisticaController@verEstadisticaCriterios')->name('estadisticaCriterios');

/* ----------------- Supevisores y alumnos en practica ---------------------------- */

/*Informatica*/
Route::get('/supervisoresPracticaEjecucion', 'SupervisorController@supervisoresEnPracticaEjecucion')->name('supervisoresPracticaEjecucion');
Route::get('/formularioEvaluacion/{id}', 'SupervisorController@index')->name('formularioEvaluacion');

Route::get('/alumnosPracticaEjecucion', 'AlumnoController@alumnosEnPracticaEjecucion')->name('alumnosPracticaEjecucion');
Route::get('/modal/solicitudModal/{id}','AlumnoController@mostrarSolicitudModal')->name('solicitudModal');
Route::get('/modal/inscripcionModal/{id}','AlumnoController@mostrarInscripcionModal')->name('inscripcionModal');
Route::get('/modal/autoEvaluacionModal/{id}','AlumnoController@mostrarAutoEvaluacionModal')->name('autoEvaluacionModal');

/*Civil*/
Route::get('/supervisoresPracticaCivil', 'SupervisorController@supervisoresEnPracticaCivil')->name('supervisoresPracticaCivil');
Route::get('/alumnosPracticaCivil', 'AlumnoController@alumnosEnPracticaCivil')->name('alumnosPracticaCivil');

/*Modal evaluacion supervisor*/
Route::get('/modal/evaluacionModal/{id}','EvaluacionSupervisorController@mostrarEvaluacionModal')->name('evaluacionModal');
Route::get('/modal/evaluacionModalInformatica/{id}','SupervisorController@mostrarEvaluacionModal')->name('evaluacionModalInformatica');