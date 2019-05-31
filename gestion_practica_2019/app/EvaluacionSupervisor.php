<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvaluacionSupervisor extends Model
{
    protected $primaryKey = 'id_eval_supervisor';

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
}
