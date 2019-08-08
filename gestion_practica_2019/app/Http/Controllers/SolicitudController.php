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
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function store(Request $request)
    {
        $fecha= date("Y-m-d H:i:s");

        Solicitud::create([
            'nombre' => $request->nombreAlumno,
            'apellido_paterno' => $request->aPaternoAlumno,
            'apellido_materno' => $request->aMaternoAlumno,
            'rut' => $request->rutAlumno,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'fono' => $request->fono,
            'anno_ingreso' => $request->añoCarrera,
            'carrera' => $request->carrera,
            'practica' => $request->practica,
            'semestre_proyecto' => $request->semestreProyecto,
            'anno_proyecto' => $request->añoProyecto,
            'f_solicitud' => $fecha,
            'resolucion_solicitud' => null,
            'observacion_solicitud' => null
        ]);

        return redirect()->route('descripcionSolicitud');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitudes = Solicitud::find($id);
        $solicitudes->delete();

        return redirect()->route('home');
    }

    public function estado($id)
    {
        $solicitudes = Solicitud::find($id);
        $solicitudes->estado = 1;

        $solicitudes->save();

        return redirect()->route('home');
    }

    /* ----------- Descripcion de Etapa ----------  */

    public function verDescripcion(){
        return view('1 Solicitud/solicitud');
    }

    /*---------------------------------------------------------------------------*/

    /* ----------- Validar una solicitud ----------  */

    public function listaSolicitudEjecucion()
    {
        $solicitudes = Solicitud::orderBy('rut','DESC')->where('carrera', 'Ingeniería de Ejecución Informática')->where("estado",0)->paginate(7);
        return view('listaSolicitudEjecucion')->with('solicitudes', $solicitudes);
    }

    public function listaSolicitudCivil()
    {
        $solicitudes = Solicitud::orderBy('rut','DESC')->where('carrera', 'Ingeniería Civil Informática')->where("estado",0)->paginate(7);
        return view('listaSolicitudCivil')->with('solicitudes', $solicitudes);
    }

    /*----------------------------------------------------------------------------*/

    /* ----------- Evaluacion de una Solicitud ----------  */

    // Civil
    /*
    public function evaluacion(){
        $solicitudesP = Solicitud::orderBy('rut','DESC')
            ->where('carrera', 'Ingeniería Civil Informática')
            ->where('estado',1)
            ->paginate(5);


    /* ----------- Validar una solicitud ----------  */

    public function listaSolicitudEjecucion()
    {
        $solicitudes = Solicitud::orderBy('rut','DESC')->where('carrera', 'Ingeniería de Ejecución Informática')->where("estado",0)->paginate(7);
        return view('1 Solicitud/listaSolicitudEjecucion')->with('solicitudes', $solicitudes);
    }

    public function listaSolicitudCivil()
    {
        $solicitudes = Solicitud::orderBy('rut','DESC')->where('carrera', 'Ingeniería Civil Informática')->where("estado",0)->paginate(7);
        return view('1 Solicitud/listaSolicitudCivil')->with('solicitudes', $solicitudes);
    }

    /*---------------------------------------------------------------------------*/

    /* ----------- Evaluacion de una Solicitud  ----------  */

    public function evaluacion(){

        $solicitudesP = Solicitud::all()
            ->where('carrera', 'Ingeniería Civil Informática')
            ->where("estado",1);

        $solicitudesE = Solicitud::all()
            ->where('carrera', 'Ingeniería Civil Informática')
            ->where("estado",2);

        return view('1 Solicitud/evaluacionSolicitud',[
            'solicitudesP'=>$solicitudesP,
            'solicitudesE'=>$solicitudesE
        ]);
    }

     public function evaluacionEjecucion(){

        $solicitudesP = Solicitud::all()
            ->where('carrera', 'Ingeniería de Ejecución Informática')
            ->where("estado",1);

        $solicitudesE = Solicitud::all()
            ->where('carrera', 'Ingeniería de Ejecución Informática')
            ->where("estado",2);

        return view('1 Solicitud/evaluacionSolicitud',[
            'solicitudesP'=>$solicitudesP,
            'solicitudesE'=>$solicitudesE
        ]);
    }

    public function evaluarSolicitudModal($id){

        $solicitud=Solicitud::find($id);
        return view('1 Solicitud/modales/modalEvaluarSolicitud',[
            'solicitud'=>$solicitud
        ]);
    }
    public function modificarEvaluacionSolicitudModal($id){

        $solicitud=Solicitud::find($id);
        return view('1 Solicitud/modales/modalModificarEvaluacionSolicitud',[
            'solicitud'=>$solicitud
        ]);
    }

    /* Funciones modales */

    public function evaluarSolicitud(Request $request, $id){

        $solicitud = Solicitud::find($id);
        if(!isset($solicitud))
            return redirect()->route('home');

        $solicitud->resolucion_solicitud = $request->resolucion;
        $solicitud->observacion_solicitud = $request->observacion;
        $solicitud->estado = 2;

        $solicitud->save();

        if($solicitud->carrera == "Ingeniería Civil Informática"){
            return redirect()->route('evaluacionSolicitud')->with('success','Registro creado satisfactoriamente');
        }
        else{
            return redirect()->route('evaluacionSolicitudEjecucion')->with('success','Registro creado satisfactoriamente');
        }
    }

    public function modificarEvaluacionSolicitud(Request $request, $id){

       $solicitud = Solicitud::find($id);
        if(!isset($solicitud))
            return redirect()->route('home');

        $solicitud->resolucion_solicitud = $request->resolucion;
        $solicitud->observacion_solicitud = $request->observacion;

        $solicitud->save();

       if($solicitud->carrera == "Ingeniería Civil Informática"){

            return redirect()->route('evaluacionSolicitud')->with('success','Registro creado satisfactoriamente');
        }
        else{
            return redirect()->route('evaluacionSolicitudEjecucion')->with('success','Registro creado satisfactoriamente');
        }
    }
}

