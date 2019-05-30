<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvalActEmpPractica extends Model
{
    protected $fillable = [
        'valor_con_emp_practica','id_practica','id_actitudinal'
    ];

    public function evaluacion_supervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
    public function eval_actitudinal(){
 		return $this->hasMany('App\EvalActitudinal');
    }
}
