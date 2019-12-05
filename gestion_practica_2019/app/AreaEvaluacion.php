<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class AreaEvaluacion extends Model
{
    protected $table = 'area_evaluacion';
    protected $fillable = [
       	'id_eval_supervisor','id_area', 'eleccion'
    ];

    public function evaluacionSupervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
    public function area(){
 		return $this->hasMany('App\Area');
    }
}
