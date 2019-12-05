<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvalConEmpPractica extends Model
{
    protected $table = 'eval_con_emp_practicas';
    protected $fillable = [
        'id_eval_supervisor','id_conocimiento', 'eleccion', 'criterio'
    ];

    public function evaluacionSupervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
    public function evalConocimiento(){
 		return $this->hasMany('App\EvalConocimiento');
    }
}
