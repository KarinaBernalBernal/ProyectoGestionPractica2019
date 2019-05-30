<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Fortaleza extends Model
{
    protected $fillable = [
       	'id_fortaleza','n_fortaleza','dp_fortaleza','id_practica'
    ];

    public function evaluaciones_supervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
}
