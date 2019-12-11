<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvalActEmpPractica extends Model
{
    protected $table = 'eval_act_emp_practica';
    protected $fillable = [
        'id_eval_supervisor','id_actitudinal', 'valor_act_emp_practica'
    ];

    public function evaluacionSupervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
    public function evalActitudinal(){
 		return $this->hasMany('App\EvalActitudinal');
    }
}
