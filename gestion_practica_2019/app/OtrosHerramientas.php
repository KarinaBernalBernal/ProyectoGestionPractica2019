<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OtrosHerramientas extends Model
{
    protected $primaryKey = 'id_otro_herramienta';

    protected $fillable = [
        'n_herramienta'
    ];

    public static function filtrarOtrosHerramienta($nombre)
    {
        $herramientas = DB::table('otros_herramientas')
            ->where('n_herramienta', 'LIKE', '%'.$nombre. '%')
            ->select('otros_herramientas.*')
            ->get();

        return $herramientas;
    }

}
