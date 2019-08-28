<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $primaryKey = 'id_recurso';

    protected $fillable = [
        'n_recurso','url','modulo'
    ];

    public function perfilRecurso(){
        return $this->belongsTo('App\PerfilRecurso');
    }
}
