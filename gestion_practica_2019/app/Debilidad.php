<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Debilidad extends Model
{
    protected $fillable = [
       	'id_debilidad','n_debilidad','dp_debilidad','id_practica'
    ];

    public function evaluaciones_supervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
}
