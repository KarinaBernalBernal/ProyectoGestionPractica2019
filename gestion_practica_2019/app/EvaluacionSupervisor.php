<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvaluacionSupervisor extends Model
{
    protected $fillable = [
       	'id_practica','porcent_tarea_realizadas','resultado_eval','f_entrega_eval'
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
    public function area_evaluacion(){
 		return $this->belongsTo('App\AreaEvaluacion');
    }
    public function eval_act_emp_practica(){
 		return $this->belongsTo('App\EvalActEmpPractica');
    }
    public function eval_con_emp_practica(){
 		return $this->belongsTo('App\EvalConEmpPractica');
    }
}
