<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;

use SGPP\Autoevaluacion;
use SGPP\Alumno;
use SGPP\Practica;
use SGPP\Desempenno;
use SGPP\Tarea;
use SGPP\Habilidad;
use SGPP\Conocimiento;
use SGPP\HerramientaPractica;
use SGPP\Herramienta;
use SGPP\AreaAutoeval;
use SGPP\Area;
use SGPP\EvalActPractica;
use SGPP\EvalActitudinal;
use SGPP\EvalConPractica;
use SGPP\EvalConocimiento;
use Auth;

class AutoEvaluacionController extends Controller
{
    public function index()
    {
        $area = Area::all();
        $herramienta = Herramienta::all();
        $actitud = EvalActitudinal::all();
        $conocimiento = EvalConocimiento::all();
        return view('3 Evaluacion/formularioAutoEvaluacion',[
            'area'=>$area,
            'herramienta'=>$herramienta,
            'actitud'=>$actitud,
            'conocimiento'=>$conocimiento,
        ]);
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

    public function store(Request $request)
    {
        $fecha= date("Y-m-d H:i:s");
        $id = auth()->user()->id_user;
        $alumnos = Alumno::where('id_user', $id)->first();
        $practicas = Practica::where('id_alumno', $alumnos->id_alumno)->first();

        $autoevaluaciones = Autoevaluacion::create([
            'id_practica' => $practicas->id_practica,
            'f_entrega' => $fecha
        ]);


        Desempenno::create([
            'id_autoeval' => $autoevaluaciones->id_autoeval,
            'valor' => $request->desempenno,
            'dp_desempenno' => $request->dpDesempenno
        ]);

        for($i = 0; $i<count($request->tarea,1); $i++)
        {
            Tarea::create([
                'id_autoeval' => $autoevaluaciones->id_autoeval,
                'n_tarea' => $request->tarea[$i],
                'dp_tarea' => $request->dptarea[$i]
            ]);
        }
        for($i = 0; $i<count($request->conocimiento,1); $i++)
        {
            Conocimiento::create([
                'id_autoeval' => $autoevaluaciones->id_autoeval,
                'n_conocimiento' => $request->conocimiento[$i],
                'dp_conocimiento' => "sin descripcion",
                'tipo_conocimiento' => 1
            ]);
        }
        for($i = 0; $i<count($request->habilidadA,1); $i++)
        {
            Habilidad::create([
                'id_autoeval' => $autoevaluaciones->id_autoeval,
                'n_habilidad' => $request->habilidadA[$i],
                'dp_habilidad' => "sin descripcion",
                'tipo_habilidad' => "aprendida"
            ]);
        }

        for($i = 0; $i<count($request->habilidadF,1); $i++)
        {
            Habilidad::create([
                'id_autoeval' => $autoevaluaciones->id_autoeval,
                'n_habilidad' => $request->habilidadF[$i],
                'dp_habilidad' => "sin descripcion",
                'tipo_habilidad' => "faltante"
            ]);
        }

        for($i = 0; $i<count($request->area,1); $i++)
        {
            $areas = Area::all()->where("n_area",$request->area[$i])->first();

            AreaAutoeval::create([
                'id_autoeval' => $autoevaluaciones->id_autoeval,
                'id_area' => $areas->id_area,
                'eleccion' => $areas->n_area
            ]);
        }

        for($i = 0; $i<count($request->herramienta,1); $i++)
        {
            $herramientas =  Herramienta::all()->where("n_herramienta",$request->herramienta[$i])->first();

            HerramientaPractica::create([
                'id_autoeval' => $autoevaluaciones->id_autoeval,
                'id_herramienta' => $herramientas->id_herramienta,
                'eleccion' => $herramientas->n_herramienta
            ]);
        }

        for($i = 0; $i<count($request->criterio,1); $i++)
        {
            $actitud =  EvalActitudinal::all()->where("id_actitudinal",$request->actitud[$i])->first();

            EvalActPractica::create([
                'id_autoeval' => $autoevaluaciones->id_autoeval,
                'id_actitudinal' => $actitud->id_actitudinal,
                'eleccion' => $request->criterio[$i],
                'criterio' => $actitud->dp_act
            ]);
        }

        for($i = 0; $i<count($request->criterio2,1); $i++)
        {
            $conocimiento =  EvalConocimiento::all()->where("id_conocimiento",$request->criterioConocimiento[$i])->first();

            EvalConPractica::create([
                'id_autoeval' => $autoevaluaciones->id_autoeval,
                'id_conocimiento' => $conocimiento->id_conocimiento,
                'eleccion' => $request->criterio2[$i],
                'criterio' => $conocimiento->dp_con
            ]);
        }


        return redirect()->route('descripcionAutoEvaluacion');
    }
}
