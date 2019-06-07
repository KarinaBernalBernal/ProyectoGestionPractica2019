<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $primaryKey = 'id_alumno';

    protected $fillable = [
        'nombre','apellido_paterno','apellido_materno','rut','email','direccion','fono','anno_ingreso','carrera','estimacion_semestre','id_user'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function solicitud(){
        return $this->belongsTo('App\Solicitud');
    }
    public function docSolicitado(){
        return $this->belongsTo('App\DocSolicitado');
    }
    public function practica(){
        return $this->belongsTo('App\Practica');    
    }
}
