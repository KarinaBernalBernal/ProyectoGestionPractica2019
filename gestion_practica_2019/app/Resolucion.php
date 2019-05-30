<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    protected $fillable = [
        'id_practica','f_resolucion','observacion_resolucion','resolucion_practica'
    ];

    public function admin(){
        return $this->hasMany('App\Administrador');
    }
    public function practica(){
        return $this->hasOne('App\Practica');
    }
}
