<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id_solicitud';

    protected $fillable = [
        'nombre','apellido_paterno','apellido_materno','rut','direccion','fono','anno_ingreso','carrera','estimacion_semestre','f_solicitud','resolucion_solicitud','observacion_solicitud','id_alumno'
    ];

    public function alumno(){
        return $this->hasMany('App\Alumno');
    }
}
