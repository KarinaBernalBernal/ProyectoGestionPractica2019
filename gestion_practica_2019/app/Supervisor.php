<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $primaryKey = 'id_supervisor';
    protected $table = 'supervisores';

    protected $fillable = [
        'nombre','apellido_paterno','cargo','departamento','email','fono','id_user','id_empresa'
    ];

    public function user(){
       return $this->belongsTo('App\User');
    }
    public function empresa(){
        return $this->hasMany('App\Empresa');
    }
    public function registroContacto(){
        return $this->belongsTo('App\RegistroContacto');
    }
    public function practica(){
        return $this->belongsTo('App\Practica');
    }

}
