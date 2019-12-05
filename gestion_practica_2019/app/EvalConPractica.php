<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvalConPractica extends Model
{
    protected $fillable = [
        'id_autoeval','id_conocimiento', 'eleccion', 'criterio'
    ];

    public function autoevaluacion(){
 		return $this->hasMany('App\Autoevaluacion');
    }
    public function evalConocimiento(){
 		return $this->hasMany('App\EvalConocimiento');
    }
}
