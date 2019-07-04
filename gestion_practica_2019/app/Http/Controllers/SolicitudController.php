<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Solicitud;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('formularioSolicitud');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha= date("Y-m-d H:i:s");

        Solicitud::create([
            'nombre' => $request->nombreAlumno,
            'apellido_paterno' => $request->aPaternoAlumno,
            'apellido_materno' => $request->aMaternoAlumno,
            'rut' => $request->rutAlumno,
            'direccion' => $request->direccion,
            'fono' => $request->fono,
            'anno_ingreso' => $request->añoCarrera,
            'carrera' => $request->carrera,
            'semestre_proyecto' => $request->semestreProyecto,
            'anno_proyecto' => $request->añoProyecto,
            'f_solicitud' => $fecha,
            'resolucion_solicitud' => null,
            'observacion_solicitud' => null
        ]);
        
        return redirect()->route('home2');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function descripcion(){
        return view('solicitud');
    }

    public function evaluacion(){
        $solicitudes = Solicitud::orderBy('rut','DESC')->paginate(9);

        return view('evaluacionSolicitud',[
            'solicitudes'=>$solicitudes,
        ]);
    }

    public function evaluarSolicitud(){
        
    }

    public function modificarEvaluacion(){
        
    }

}
