<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class PerfilRecurso extends Model
{
    protected $fillable = [
        'id_perfil','id_recurso'
    ];

    public function recurso(){
 		return $this->hasMany('App\Recurso');
    }
    public function perfil(){
 		return $this->hasMany('App\Perfil');
    }
}
