<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\DeclareDeclare;
use SGPP\Practica;
use Illuminate\Support\Facades\DB;

class PracticaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_administrador');

    }
    //vista principal de un elemento en especifico
    public function lista( Request $request)
    {
        $lista = DB::table('practicas')
            ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
            ->join('supervisores', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
            ->select('practicas.*', 'alumnos.rut', 'supervisores.email' )
            ->get();

        $listaNoInscritos =DB::table('practicas')
            ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
            ->leftJoin('supervisores', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
            ->where('practicas.f_inscripcion', '=', null)
            ->select('practicas.*', 'alumnos.rut')
            ->get();

        $contadorNoInscritos = $listaNoInscritos->count();

        if ($request->f_solicitud != null || $request->f_inscripcion != null || $request->asistenciaCharla || $request->rutAlumno != null || $request->emailSupervisor)
        {
            //-----Filtro-----//
            $listaFiltrada= Practica::filtrarPracticasInscritas(
                $request->get('f_solicitud'),
                $request->get('f_inscripcion'),
                $request->get('rutAlumno'),
                $request->get('emailSupervisor')
            );
            $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
            $listaFiltrada = $listaFiltrada->paginateEspecial(10, null, null, "page1");
            $listaNoInscritos = $listaNoInscritos->paginateEspecial(10, null, null, "page2");
            return view('Mantenedores/Practicas/lista_practicas')
                ->with('lista',$listaFiltrada)
                ->with('contador',$contador)
                ->with('listaNoInscritos',$listaNoInscritos)
                ->with('contadorNoInscritos',$contadorNoInscritos);
        }
        $contador = $lista->count();
        $lista = $lista->paginateEspecial(10, null, null, "page1");
        $listaNoInscritos = $listaNoInscritos->paginateEspecial(10, null, null, "page2");
        return view('Mantenedores/Practicas/lista_practicas',[
                'lista'=>$lista,
                'contador'=>$contador,
                'listaNoInscritos'=>$listaNoInscritos,
                'contadorNoInscritos'=>$contadorNoInscritos,
            ]);
    }

    public function listaNoInscritos( Request $request)
    {
        $lista = DB::table('practicas')
            ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
            ->join('supervisores', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
            ->select('practicas.*', 'alumnos.rut', 'supervisores.email' )
            ->get();

        $listaNoInscritos = DB::table('practicas')
            ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
            ->leftJoin('supervisores', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
            ->where('practicas.f_inscripcion', '=', null)
            ->select('practicas.*', 'alumnos.rut', 'supervisores.email' )
            ->get();

        $contador = $lista->count();

        if ($request->f_solicitud != null|| $request->rutAlumno != null)
        {
            //-----Filtro-----//
            $listaFiltrada= Practica::filtrarPracticasNoInscritas(
                $request->get('f_solicitud'),
                $request->get('rutAlumno')
            );
            $contadorNoInscritos = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
            $lista= $lista->paginateEspecial(10, null, null, "page1");
            $listaFiltrada = $listaFiltrada->paginateEspecial(10, null, null, "page2");
            return view('Mantenedores/Practicas/lista_practicas')
                ->with('listaNoInscritos',$listaFiltrada)
                ->with('contadorNoInscritos',$contadorNoInscritos)
                ->with('lista', $lista)
                ->with('contador',$contador);
        }

        $contadorNoInscritos = $listaNoInscritos->count();
        $lista = $lista->paginateEspecial(10, null, null, "page1");
        $listaNoInscritos = $listaNoInscritos->paginateEspecial(10, null, null, "page2");
        return view('Mantenedores/Practicas/lista_practicas',[
            'lista'=>$lista,
            'contador'=>$contador,
            'listaNoInscritos'=>$listaNoInscritos,
            'contadorNoInscritos'=>$contadorNoInscritos,
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

            $elemento_editar->f_solicitud= $request->f_solicitud;
            $elemento_editar->f_inscripcion=$request->f_inscripcion;
            $elemento_editar->f_desde=$request->f_desde;
            $elemento_editar->f_hasta=$request->f_hasta;
            $elemento_editar->asist_ch_post_pract=$request->asist_ch_post_pract;
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