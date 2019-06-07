<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvalActEmpPractica extends Model
{
    protected $fillable = [
        'valor_act_emp_practica','id_eval_supervisor','id_actitudinal'
    ];

    public function evaluacionSupervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
    public function evalActitudinal(){
 		return $this->hasMany('App\EvalActitudinal');
    }
}
