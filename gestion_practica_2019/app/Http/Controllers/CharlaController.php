<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\DeclareDeclare;
use SGPP\Practica;
use SGPP\Charla;
use SGPP\Alumno;
use Illuminate\Support\Facades\DB;

class CharlaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_administrador');

    }

    public function lista( Request $request)
    {
        $charla = DB::table('charlas')
            ->select('charlas.*')
            ->orderBy('f_charla', 'desc')
            ->get();

        if ($request->clave != null || $request->sala != null || $request->f_charla)
        {
            //-----Filtro-----//
            $listaFiltrada= Charla::filtrarCharla(
                $request->get('clave'),
                $request->get('sala'),
                $request->get('f_charla')
            );
            $contadorFiltrado = $listaFiltrada->count();
            $listaFiltrada = $listaFiltrada->paginate(2);

            return view('Charlas/lista_charla')
                ->with('charla',$listaFiltrada)
                ->with('contador',$contadorFiltrado);
        }
        $contador = $charla->count();
        $charla = $charla->paginate(2);

        return view('Charlas/lista_charla',[
                'charla'=>$charla,
                'contador'=>$contador,
            ]);
    }

    public function listaParticipantes( Request $request, $idCharla)
    {
        $alumnos = DB::table('alumnos')
            ->join('practicas', 'practicas.id_alumno', 'alumnos.id_alumno')
            ->join('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->whereNull('practicas.id_charla')
            ->orWhere('practicas.resolucion_charla', '=', "pendiente")
            ->where('practicas.id_charla', '!=', $idCharla)
            ->select('alumnos.*', 'practicas.resolucion_charla')
            ->get();

        if ($request->nombre != null || $request->apellido_paterno != null || $request->rut != null ||  $request->carrera != null || $request->resolucion_charla != null)
        {
            $listaFiltrada= Alumno::filtrarAlumnosCharla(
                $request->get('nombre'),
                $request->get('apellido_paterno'),
                $request->get('rut'),
                $request->get('carrera'),
                $request->get('resolucion_charla'),
                $idCharla

            );
            $listaFiltrada = $listaFiltrada->paginate(2);

            return view('Charlas/lista_participantes')
                ->with('alumnos',$listaFiltrada)
                ->with('idCharla', $idCharla);
        }
        $alumnos = $alumnos->paginate(2);

        return view('Charlas/lista_participantes',[
            'alumnos'=>$alumnos,
            'idCharla'=>$idCharla,
        ]);
    }

    public function listaAsistencia($idCharla)
    {
        $invitados = DB::table('alumnos')
            ->join('practicas', 'practicas.id_alumno', 'alumnos.id_alumno')
            ->join('charlas', 'charlas.id_charla', 'practicas.id_charla')
            ->where('practicas.id_charla', $idCharla)
            ->select('charlas.*', 'alumnos.*', 'practicas.asistencia_charla', 'practicas.id_practica')
            ->orderBy('alumnos.apellido_paterno', 'desc')
            ->get();

        return view('Charlas/asistencia_charla',[
            'invitados'=>$invitados,
            'idCharla'=>$idCharla,
        ]);
    }

    public function modificarAsistencia(Request $request)
    {

        $elemento = Practica::all()->where('id_practica', $request->id)->first();

        if($elemento->asistencia_charla != 0)
        {
            $elemento->asistencia_charla = 0;
        }else
        {
            $elemento->asistencia_charla = 1;
        }
        $elemento->save();
    }

    public function listaResolucion($idCharla)
    {
        $alumnos = DB::table('alumnos')
            ->join('practicas', 'practicas.id_alumno', 'alumnos.id_alumno')
            ->where('practicas.id_charla', $idCharla)
            ->select('alumnos.*', 'practicas.*')
            ->orderBy('alumnos.apellido_paterno', 'desc')
            ->get();

        return view('Charlas/resolucion_charla',[
            'alumnos'=>$alumnos,
            'idCharla'=>$idCharla,
        ]);
    }

    public function modificarResolucion(Request $request)
    {
        for($i = 0; $i<count($request->resolucion,1); $i++)
        {
            $elemento = Practica::find($request->alumno[$i]);
            if($request->resolucion[$i] != null)
            {
                $elemento->resolucion_charla = $request->resolucion[$i];
            }
            $elemento->save();
        }
        return redirect()->route('lista_charlas');
    }

    public function crear(Request $request)
    {
        return view('Charlas/crear_charla');
    }

    public function editar($id_elemento)
    {
        $elemento= Charla::find($id_elemento);
        $alumnos = DB::table('alumnos')
            ->join('practicas', 'practicas.id_alumno', 'alumnos.id_alumno')
            ->where('practicas.id_charla', $id_elemento)
            ->select('alumnos.*', 'practicas.*')
            ->orderBy('alumnos.apellido_paterno', 'desc')
            ->get();
        return view('Charlas/editar_charla',[
                'elemento'=>$elemento,
                'alumnos'=>$alumnos,
            ]);
    }

    public function crearCharla(Request $request)
    {
        $data = $request->all();

        $nuevo = new Charla();
        $nuevo->clave = $data['clave'];
        $nuevo->sala = $data['sala'];
        $nuevo->f_charla = $data['f_charla'];
        $nuevo->save();

        return redirect()->route('lista_charlas');
    }

    public function crearParticipante(Request $request, $idCharla)
    {
        if($request->invitacion)
        {
            for($i = 0; $i<count($request->invitacion,1); $i++)
            {
                $alumno = Alumno::find($request->invitacion[$i]);
                $practica = Practica::where('id_alumno', $alumno->id_alumno)->first();
                $practica->id_charla = $idCharla;
                $practica->save();
            }
        }

        return redirect()->route('lista_participantes',[$idCharla]);
    }

    public function editarCharla(Request $request, $id_elemento)
    {
        $elemento_editar=Charla::find($id_elemento);
        if(isset($elemento_editar))
        {

            $elemento_editar->clave = $request->clave;
            $elemento_editar->sala = $request->sala;
            $elemento_editar->f_charla = $request->f_charla;

            $elemento_editar->save();

        }
        return redirect()->route('lista_charlas');
    }
    public function borrarCharla($id_elemento)
    {
        $elemento_eliminar =  Charla::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_charlas');
    }

    public function borrarParticipante($id_elemento)
    {
        $elemento_eliminar = Practica::find($id_elemento);
        $elemento_eliminar->id_charla = null;
        $elemento_eliminar->save();

        return redirect()->route('lista_charlas');
    }

}