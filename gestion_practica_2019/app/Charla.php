<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Charla extends Model
{
    protected $primaryKey = 'id_charla';

    protected $fillable = [
        'clave','sala','f_charla'
    ];
    public function practica(){
        return $this->belongsTo('App\Practica');
    }


    public static function filtrarCharla($clave, $sala, $f_charla)
    {
        $charla = DB::table('charlas')
            ->where('clave', 'LIKE', '%'.$clave. '%')
            ->where('sala', 'LIKE', '%'.$sala. '%')
            ->where('f_charla', 'LIKE', '%'.$f_charla. '%')
            ->select('charlas.*')
            ->get();

        return $charla;
    }


}
