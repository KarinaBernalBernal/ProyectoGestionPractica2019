<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id_solicitud';

    protected $fillable = [
        'nombre','apellido_paterno','apellido_materno','rut','email','direccion','fono','anno_ingreso','carrera','practica','semestre_proyecto','anno_proyecto','f_solicitud','resolucion_solicitud','observacion_solicitud','id_alumno'
    ];

    public function alumno(){
        return $this->hasMany('App\Alumno');
    }
}
