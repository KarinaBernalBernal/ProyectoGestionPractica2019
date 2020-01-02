<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EvalActitudinal extends Model
{
    protected $table = 'eval_actitudinales';
    protected $primaryKey = 'id_actitudinal';

    protected $fillable = [
        'n_act','dp_act', 'vigencia'
    ];

    public function evalActPractica(){
 		return $this->belongsTo('App\EvalActPractica');
    }
    public function evalActEmpPractica(){
 		return $this->belongsTo('App\EvalActEmpPractica');
    }

    public static function filtrarEvalActitudinal($nombre, $vigencia)
    {
        $evaluacionActitudinal = DB::table('eval_actitudinales')
            ->where('n_act', 'LIKE', '%'.$nombre. '%')
            ->where('vigencia', 'LIKE', '%'.$vigencia. '%')
            ->select('eval_actitudinales.*')
            ->get();

        return $evaluacionActitudinal;
    }

}
