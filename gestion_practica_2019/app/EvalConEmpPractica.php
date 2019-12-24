<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvalConEmpPractica extends Model
{
    protected $table = 'eval_con_emp_practicas';
    protected $fillable = [
        'id_eval_supervisor','id_conocimiento', 'valor_con_emp_practica'
    ];

    public function evaluacionSupervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
    public function evalConocimiento(){
 		return $this->hasMany('App\EvalConocimiento');
    }
}
