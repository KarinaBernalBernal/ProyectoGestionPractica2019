<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\EvalActPractica;
use SGPP\Autoevaluacion;
use SGPP\Practica;
use SGPP\Alumno;

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
    
    public function buscarAlumno(Request $request){
        //return view('Estadisticas/........');
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
