<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = [
        'id_recurso','nombre','url'
    ];

    public function perfil_recurso(){
        return $this->belongsTo('App\PerfilRecurso');
    }
}
