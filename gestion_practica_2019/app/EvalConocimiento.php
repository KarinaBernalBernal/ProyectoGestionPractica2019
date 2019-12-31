<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EvalConocimiento extends Model
{
    protected $primaryKey = 'id_conocimiento';

    protected $fillable = [
       	'n_con','dp_con', 'vigencia'
    ];

    public function evalConPractica(){
 		return $this->belongsTo('App\EvalConPractica');
    }
    public function evalConEmpPractica(){
 		return $this->belongsTo('App\EvalConEmpPractica');
    }

    public static function filtrarEvalConocimiento($nombre, $vigencia)
    {
        $evalConocimiento = DB::table('eval_conocimientos')
            ->where('n_con', 'LIKE', '%'.$nombre. '%')
            ->where('vigencia', 'LIKE', '%'.$vigencia. '%')
            ->select('eval_conocimientos.*')
            ->get();

        return $evalConocimiento;
    }
}
