<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Area extends Model
{
    protected $primaryKey = 'id_area';

    protected $fillable = [
       	'n_area', 'vigencia'
    ];

    public function areaAutoeval(){
 		return $this->belongsTo('App\AreaAutoeval');
    }
    public function areaEvaluacion(){
 		return $this->belongsTo('App\AreaEvaluacion');
    }

    public static function filtrarArea($nombre, $vigencia)
    {
        $areas = DB::table('areas')
            ->where('n_area', 'LIKE', '%'.$nombre. '%')
            ->where('vigencia', 'LIKE', '%'.$vigencia. '%')
            ->select('areas.*')
            ->get();

        return $areas;
    }
}
