<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvalConocimiento extends Model
{
    protected $primaryKey = 'id_conocimiento';

    protected $fillable = [
       	'n_con','dp_con'
    ];

    public function evalConPractica(){
 		return $this->belongsTo('App\EvalConPractica');
    }
    public function evalConEmpPractica(){
 		return $this->belongsTo('App\EvalConEmpPractica');
    }

}
