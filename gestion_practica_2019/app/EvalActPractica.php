<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvalActPractica extends Model
{
    protected $table = 'eval_act_practicas';
    protected $fillable = [
        'id_autoeval','id_actitudinal', 'valor_act_practica'
    ];

    public function autoevaluacion(){
 		return $this->hasMany('App\Autoevaluacion');
    }
    public function evalActitudinal(){
 		return $this->hasMany('App\EvalActitudinal');
    }
}
