<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class RegistroContacto extends Model
{
    protected $primaryKey = 'id_registro_contacto';

    protected $fillable = [
        'tipo_contacto','cant_contacto','observacion_contacto','f_contacto','id_supervisor','id_admin','id_practica'
    ];

    public function admin(){
       return $this->hasMany('App\Administrador');
    }
    public function supervisor(){
       return $this->hasMany('App\Supervisor');
    }
    public function pratica(){
    	return $this->hasOne('App\Practica');
    }
}
