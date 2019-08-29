<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Debilidad extends Model
{
    protected $table = 'debilidades';
    protected $primaryKey = 'id_debilidad';

    protected $fillable = [
       	'n_debilidad','dp_debilidad','id_eval_supervisor'
    ];

    public function evaluacionSupervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
}
