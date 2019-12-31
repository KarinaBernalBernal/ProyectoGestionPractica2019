<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Herramienta extends Model
{
    protected $primaryKey = 'id_herramienta';

    protected $fillable = [
       	'n_herramienta', 'vigencia'
    ];

    public function herramientaPractica(){
 		return $this->belongsTo('App\HerramientaPractica');
    }

    public static function filtrarHerramienta($nombre, $vigencia)
    {
        $herramientas = DB::table('herramientas')
            ->where('n_herramienta', 'LIKE', '%'.$nombre. '%')
            ->where('vigencia', 'LIKE', '%'.$vigencia. '%')
            ->select('herramientas.*')
            ->get();

        return $herramientas;
    }
}
