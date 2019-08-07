<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $primaryKey = 'id_perfil';
    protected $table = 'perfiles';

    protected $fillable = [
       	'n_perfil'
<<<<<<< HEAD
=======
       	// ,'id_user'
>>>>>>> b774f165a643d6c5b1158d1f0611698e4aa9f89e
    ];

    public function perfilRecurso(){
 		return $this->belongsTo('App\PerfilRecurso');
    }
}
