<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;

use SGPP\Autoevaluacion;

class AutoEvaluacionController extends Controller
{
    public function index()
    {
        return view('3 Evaluacion/formularioAutoEvaluacion');
    }
    public function verDescripcionAutoEvaluacion(){
        return view('3 Evaluacion/autoEvaluacion');
    }
     //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Autoevaluacion::all();
        return view('Mantenedores/Evaluaciones/Alumno/lista_auto_evaluaciones',[
                'lista'=>$lista,
            ]);
    }
    public function crear()
    {
        return view('Mantenedores/Evaluaciones/Alumno/crear_auto_evaluacion');
    }

    public function editar($id_elemento)
    {
        $elemento= Autoevaluacion::find($id_elemento);
        return view('Mantenedores/Evaluaciones/Alumno/editar_auto_evaluacion',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearAutoEvaluacion (Request $request)
    {
        $data = $request->all();

        $nuevo = new Autoevaluacion;
        $nuevo->f_entrega = $data['f_entrega'];
		$nuevo->id_practica = $data['id_practica'];

        $nuevo->save();

        return redirect()->route('lista_auto_evaluaciones');
    }

    public function editarAutoEvaluacion(Request $request, $id_elemento)
    {
        $elemento_editar=Autoevaluacion::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->f_entrega=$request->f_entrega;
			$elemento_editar->id_practica=$request->id_practica;
            $elemento_editar->save();

            return redirect()->route('lista_auto_evaluaciones');
        }
    }
    public function borrarAutoEvaluacion($id_elemento){
        $elemento_eliminar =  Autoevaluacion::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_auto_evaluaciones');
    }

    public function index()
    {
        return view('formularioAutoEvaluacion');
    }

}
