<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    protected $primaryKey = 'id_resolucion';

    protected $fillable = [
       'f_resolucion','observacion_resolucion','resolucion_practica','id_practica','id_admin'
    ];

    public function admin(){
        return $this->hasMany('App\Administrador');
    }
    public function practica(){
       return $this->hasOne('App\Practica');
    }
}
