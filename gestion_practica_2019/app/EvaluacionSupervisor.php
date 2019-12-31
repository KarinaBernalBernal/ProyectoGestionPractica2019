<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EvaluacionSupervisor extends Model
{
    protected $primaryKey = 'id_eval_supervisor';
    protected $table = 'evaluaciones_supervisor';

    protected $fillable = [
       	'porcent_tareas_realizadas','resultado_eval','f_entrega_eval','id_practica'
    ];

    public function practica(){
 		return $this->hasOne('App\Practica');
    }
    public function fortaleza(){
 		return $this->belongsTo('App\Fortaleza');
    }
    public function debilidad(){
 		return $this->belongsTo('App\Debilidad');
    }
    public function areaEvaluacion(){
 		return $this->belongsTo('App\AreaEvaluacion');
    }
    public function evalActEmpPractica(){
 		return $this->belongsTo('App\EvalActEmpPractica');
    }
    public function evalConEmpPractica(){
 		return $this->belongsTo('App\EvalConEmpPractica');
    }

    public static function filtrarEvaluaciones($nombre, $apellido_paterno, $email, $fono, $f_entrega_eval, $carrera)
    {
        $evaluacionesFiltradas = DB::table('supervisores')
            ->join('practicas', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
            ->join('alumnos', 'alumnos.id_alumno', '=', 'practicas.id_alumno')
            ->join('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->where('practicas.f_inscripcion', '!=', null)
            ->where('supervisores.nombre', 'LIKE', '%'.$nombre. '%')
            ->where('supervisores.apellido_paterno', 'LIKE', '%'.$apellido_paterno. '%')
            ->where('supervisores.email', 'LIKE', '%'.$email. '%')
            ->where('supervisores.fono', 'LIKE', '%'.$fono. '%')
            ->where('carrera', 'LIKE', '%'.$carrera. '%')
            ->where('evaluaciones_supervisor.f_entrega_eval', 'LIKE', '%'.$f_entrega_eval . '%')
            ->select('supervisores.*', 'evaluaciones_supervisor.*', 'alumnos.nombre as nombre_alumno', 'alumnos.apellido_paterno as apellido_alumno')
            ->get();

        return $evaluacionesFiltradas;
    }

    public static function filtrarEvaluacionesMantenedor($email, $rut, $porcent_tareas_realizadas, $resultado_eval, $f_entrega_eval)
    {
        $evaluacionesFiltradas = DB::table('evaluaciones_supervisor')
            ->join('practicas', 'practicas.id_practica', '=', 'evaluaciones_supervisor.id_practica')
            ->join('alumnos', 'alumnos.id_alumno', '=', 'practicas.id_alumno')
            ->join('supervisores', 'supervisores.id_supervisor', '=', 'practicas.id_supervisor')
            ->where('supervisores.email', 'LIKE', '%'.$email. '%')
            ->where('alumnos.rut', 'LIKE', '%'.$rut. '%')
            ->where('porcent_tareas_realizadas', 'LIKE', '%'.$porcent_tareas_realizadas. '%')
            ->where('resultado_eval', 'LIKE', '%'.$resultado_eval. '%')
            ->where('f_entrega_eval', 'LIKE', '%'.$f_entrega_eval. '%')
            ->select('evaluaciones_supervisor.*','supervisores.email', 'alumnos.rut')
            ->get();

        return $evaluacionesFiltradas;
    }

}
