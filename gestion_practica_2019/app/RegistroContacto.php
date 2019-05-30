<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class RegistroContacto extends Model
{
    protected $fillable = [
        'id_practica','tipo_contacto','cant_contacto','observacion_contacto','f_contacto','id_supervisor','id_admin'
    ];

    public function admin(){
       return $this->hasMany('App\Administrador');
    }
    public function supervisor(){
       return $this->hasMany('App\Supervisor');
    }
    public function pratica(){
    	return $this->hasOne('App\RegistroContacto');
    }
}
