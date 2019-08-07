<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Practica;

class PracticaController extends Controller
{
    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Practica::all();
        return view('Mantenedores/Practicas/lista_practicas',[
                'lista'=>$lista,
            ]);
    }
     public function crear()
    {
        return view('Mantenedores/Practicas/crear_practica');
    }

    public function editar($id_elemento)
    {
        $elemento= Practica::find($id_elemento);
        return view('Mantenedores/Practicas/editar_practica',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearPractica (Request $request)
    {
        $data = $request->all();

        $nuevo = new Practica;
        $nuevo->f_solicitud = $data['f_solicitud'];
        $nuevo->f_inscripcion = $data['f_inscripcion'];
        $nuevo->f_desde = $data['f_desde'];
        $nuevo->f_hasta = $data['f_hasta'];
        $nuevo->asist_ch_post_pract = $data['asist_ch_post_pract'];
        $nuevo->asist_ch_pre_pract = $data['asist_ch_pre_pract'];
        $nuevo->id_alumno = $data['id_alumno'];
        $nuevo->id_supervisor = $data['id_supervisor'];

        $nuevo->save();

        return redirect()->route('lista_practicas');
    }

    public function editarPractica(Request $request, $id_elemento)
    {
        $elemento_editar=Practica::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->f_solicitud=$request->f_solicitud;
            $elemento_editar->f_inscripcion=$request->f_inscripcion;
            $elemento_editar->f_desde=$request->f_desde;
            $elemento_editar->f_hasta=$request->f_hasta;
            $elemento_editar->asist_ch_post_pract=$request->asist_ch_post_pract;
            $elemento_editar->asist_ch_pre_pract=$request->asist_ch_pre_pract;
            $elemento_editar->id_alumno=$request->id_alumno;
            $elemento_editar->id_supervisor=$request->id_supervisor;

            $elemento_editar->save();

            return redirect()->route('lista_practicas');
        }
    }
    public function borrarPractica($id_elemento){
        $elemento_eliminar =  Practica::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_practicas');
    }

}