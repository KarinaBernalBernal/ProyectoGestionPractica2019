<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Fortaleza extends Model
{
    protected $primaryKey = 'id_fortaleza';

    protected $fillable = [
       	'n_fortaleza','dp_fortaleza','id_eval_supervisor'
    ];

    public function evaluacionSupervisor(){
 		return $this->hasMany('App\EvaluacionSupervisor');
    }
}
