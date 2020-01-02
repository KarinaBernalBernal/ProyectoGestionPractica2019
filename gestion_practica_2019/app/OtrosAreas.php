<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OtrosAreas extends Model
{
    protected $primaryKey = 'id_otro_area';

    protected $fillable = [
        'n_area'
    ];

    public static function filtrarOtrosArea($nombre)
    {
        $areas = DB::table('otros_areas')
            ->where('n_area', 'LIKE', '%'.$nombre. '%')
            ->select('otros_areas.*')
            ->get();

        return $areas;
    }


}
