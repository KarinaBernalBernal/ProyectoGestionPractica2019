<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvalConEmpPractica extends Model
{
    protected $fillable = [
        'valor_con_emp_practica','id_practica','id_conocimiento'
    ];

    public function evaluacion_supervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
    public function eval_conocimiento(){
 		return $this->hasMany('App\EvalConocimiento');
    }
}
