<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Practica;
use SGPP\Alumno;
use SGPP\Supervisor;
use SGPP\Empresa;

use SGPP\Autoevaluacion;
use SGPP\Desempenno;
use SGPP\Tarea;
use SGPP\Habilidad;
use SGPP\Conocimiento;
use SGPP\HerramientaPractica;
use SGPP\AreaAutoeval;
use SGPP\EvalActPractica;
use SGPP\EvalConPractica;
use SGPP\Area;
use SGPP\Herramienta;

class EstadisticaController extends Controller
{
    public function verEstadisticaCriteriosAutoeval(){
        $anio = date('y');

        $evalActEjec = $this->obtenerEvalAct($anio-3, $anio,'Ingeniería de Ejecución Informática');
        //evalActCivil = obtenerEvalAct($annio-3,$annio,'Ingeniería Civil Informática');
        //evalConEjec = obtenerEvalCon($annio-3,$annio,'Ingeniería de Ejecución Informática');
        //evalConCivil = obtenerEvalCon($annio-3,$annio,'Ingeniería Civil Informática');
        
        return view('Estadisticas/estadisticaCriteriosAutoeval')->with('evalActEjec', $evalActEjec);
    }
    //---------------------- funciones de detalles del alumno-------------------
    public function buscarAlumno(Request $request){
        $lista= Alumno::filtrarYPaginar($request->get('buscador'),
                                        $request->get('nombre'), 
                                        $request->get('apellido_paterno'),
                                        $request->get('apellido_materno'),
                                        $request->get('email'),
                                        $request->get('anno_ingreso'),
                                        $request->get('carrera')
                                    );
        return view('Estadisticas/AlumnosDetalles')->with("lista", $lista);
    }
    /*  Funciones Modales de Estadisticas Alumno  */
    public function mostrarEstadisticasAlumno($id){
        $alumno = Alumno::find($id);
        $practicas = Practica::where('id_alumno',$id)->paginate(12);

        //Lista de supervisores
        $supervisores = new Supervisor();
        $supervisores = collect([]);

        foreach($practicas as $practica){
            $resultadoSupervisor = Supervisor::where('id_supervisor', $practica->id_supervisor)->first();
            $supervisores->push($resultadoSupervisor);
        }

        //Lista de empresas del alumno
        $empresas = new Empresa();
        $empresas = collect([]);

        foreach($supervisores as $supervisor){
            $resultadoEmpresa= Empresa::where('id_empresa', $supervisor->id_empresa)->first();
            $empresas->push($resultadoEmpresa);
        }

        return view('Estadisticas/datosAlumno')
                    ->with("alumno", $alumno)
                    ->with("practicas", $practicas)
                    ->with('supervisores', $supervisores)
                    ->with('empresas', $empresas);                      
    }
    //--- modal autoevaluacionAlumno
    public function mostrarAutoevaluacionAlumno($id){
        $autoevaluacion = Autoevaluacion::where('id_practica',$id)->first();
        
        $desempeño = Desempenno::where('id_autoeval',$autoevaluacion->id_autoeval)->first();
        $tareas = Tarea::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
        $habilidades = Habilidad::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
        $conocimientos = Conocimiento::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
        
        $herramientaPracticas = HerramientaPractica::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
        $areaAutoevals = AreaAutoeval::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);

        $herramientas = Herramienta::orderby('id_herramienta', 'DESC')->paginate(12);
        $areas = Area::orderby('id_area', 'DESC')->paginate(12);
        /*$evalActPractica = EvalActPractica::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
        $evalConPractica = EvalConPractica::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);*/
        
        return view('Estadisticas/modales/mostrarAutoevaluacionAlumno')->with("autoevaluacion", $autoevaluacion)
                ->with("desempeño", $desempeño)->with("tareas", $tareas)
                ->with("habilidades", $habilidades)->with("conocimientos", $conocimientos)
                ->with("herramientas", $herramientas)->with("areas", $areas)
                ->with("herramientaPracticas", $herramientaPracticas)->with("areaAutoevals", $areaAutoevals);
                
                //->with("evalActPractica", $evalActPractica)->with("evalConPractica", $evalConPractica);
    }

    public function mostrarEvaluacionSupervisor($id){
        $alumno = Alumno::find($id);
        

        return view('Estadisticas/modales/mostrarEvaluacionSupervisor')->with("alumno", $alumno);
    }


    //---------------------- funciones de EstadisticaCriteriosAutoeval -------------------
    public function obtenerEvalAct($anioInicio, $anioTermino, $carrera){
        $evalAct = EvalActPractica::all();
        $criterios = [];
        $cont = 0;

        for($i=0; $i<sizeof($evalAct); $i++){
            $autoeval = Autoevaluacion::find($evalAct[$i]->id_autoeval);

            if($autoeval->f_entrega_autoeval>=$anioInicio || $autoeval->f_entrega_autoeval<=$anioTermino){
                $practica = Practica::find($autoeval->id_practica);
                $alumno = Alumno::find($practica->id_alumno);
                
                if($alumno->carrera == $carrera){
                    if($autoeval->valor_act_practica == '1')
                        $criterios[$autoeval->id_actitudinal-1]["opcion 1"] = $criterios[$autoeval->id_actitudinal-1]["opcion 1"] + 1;
                    if($autoeval->valor_act_practica == '2')
                        $criterios[$autoeval->id_actitudinal-1]["opcion 2"] = $criterios[$autoeval->id_actitudinal-1]["opcion 2"] + 1;
                    if($autoeval->valor_act_practica == '3')
                        $criterios[$autoeval->id_actitudinal-1]["opcion 3"] = $criterios[$autoeval->id_actitudinal-1]["opcion 3"] + 1;
                    if($autoeval->valor_act_practica == '4')
                        $criterios[$autoeval->id_actitudinal-1]["opcion 4"] = $criterios[$autoeval->id_actitudinal-1]["opcion 4"] + 1;
                }
            }
        }
        return $criterios;
    }
}
