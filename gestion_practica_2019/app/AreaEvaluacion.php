<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class AreaEvaluacion extends Model
{
    protected $fillable = [
       	'id_practica','id_area'
    ];

    public function evaluaciones_supervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
    public function area(){
 		return $this->hasMany('App\Area');
    }
}
