<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $primaryKey = 'id_perfil';
    protected $table = 'perfiles';

    protected $fillable = [
       	'n_perfil'
    ];

    public function perfilRecurso(){
 		return $this->belongsTo('App\PerfilRecurso');
    }
}
