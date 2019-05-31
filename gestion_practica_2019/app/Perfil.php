<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $primaryKey = 'id_perfil';

    protected $fillable = [
       	'n_perfil','id_user'
    ];

    public function user(){
 		return $this->hasMany('App\User');
    }
    public function perfilRecurso(){
 		return $this->belongsTo('App\PerfilRecurso');
    }
}
