<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nombre','apellido_paterno','apellido_materno','rut','email','cargo','id_user'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function resolucion(){
        return $this->belongsTo('App\Resolucion');
    }
    public function registroContacto(){
        return $this->belongsTo('App\RegistroContacto');
    }
}
