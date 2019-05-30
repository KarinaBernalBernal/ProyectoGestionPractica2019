<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = [
       	'id_perfil','n_perfil','id_user'
    ];

    public function users(){
 		return $this->hasMany('App\User');
    }
    public function perfil_recurso(){
 		return $this->belongsTo('App\PerfilRecurso');
    }
}
