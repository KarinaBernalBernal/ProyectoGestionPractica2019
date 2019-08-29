<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class EvalActitudinal extends Model
{
    protected $table = 'eval_actitudinales';
    protected $primaryKey = 'id_actitudinal';

    protected $fillable = [
        'n_act','dp_act'
    ];

    public function evalActPractica(){
 		return $this->belongsTo('App\EvalActPractica');
    }
    public function evalActEmpPractica(){
 		return $this->belongsTo('App\EvalActEmpPractica');
    }
}
