<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Autoevalucion extends Model
{
    protected $primaryKey = 'id_autoeval';

    protected $fillable = [
       	'f_entrega','id_practica'
    ];

    public function practica(){
 		return $this->belongsTo('App\User');
    }
    public function desempenno(){
 		return $this->hasOne('App\Desempenno');
    }
    public function tarea(){
 		return $this->belongsTo('App\Tarea');
    }
    public function habilidad(){
 		return $this->belongsTo('App\Habilidad');
    }
    public function conocimiento(){
 		return $this->belongsTo('App\Conocimiento');
    }
    public function herramientaPractica(){
 		return $this->belongsTo('App\HerramientaPractica');
    }
    public function areaAutoeval(){
 		return $this->belongsTo('App\AreaAutoeval');
    }
    public function evalActPractica(){
 		return $this->belongsTo('App\EvalActPractica');
    }
    public function evalConPractica(){
 		return $this->belongsTo('App\EvalConPractica');
    }
}
