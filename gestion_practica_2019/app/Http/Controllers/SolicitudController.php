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
        $estimacion = $request->semestre . '-' . $request->AñoProyecto;
        //$fecha = new \DateTime();
        $fecha= date("Y-m-d H:i:s");

        Solicitud::create([
            'nombre' => $request->nombreAlumno,
            'apellido_paterno' => $request->APaternoAlumno,
            'apellido_materno' => $request->AMaternoAlumno,
            'rut' => $request->rutAlumno,
            'direccion' => $request->direccion,
            'fono' => $request->fono,
            'anno_ingreso' => $request->AñoCarrera,
            'carrera' => $request->carrera,
            'estimacion_semestre' => $estimacion,
            'f_solicitud' => $fecha,//->format('d-m-Y'),
            'resolucion_solicitud' => null,
            'observacion_solicitud' => null
        ]);
        
        return redirect()->route('home2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /*$estimacion = $semestre + '-' + $AñoProyecto;
       $fecha = new \DateTime();

       $this->validate($request,[ 
            'nombre' => $request->$nombreAlumno,
            'apellido_paterno' => $request->$APaternoAlumno,
            'apellido_materno' => $request->$AMaternoAlumno,
            'rut' => $request->$rutAlumno,
            'direccion' => $request->$direccion,
            'fono' => $request->$fono,
            'anno_ingreso' => $request->$AñoCarrera,
            'carrera' => $request->$carrera,
            'estimacion_semestre' => $request->$estimacion ,
            'f_solicitud' => $request->$fecha->format('d-m-Y H:i:s'), 
        ]);
        */
        //return redirect()->route('perfil',['Usuario'])->with('success','Registro creado satisfactoriamente');

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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

}
