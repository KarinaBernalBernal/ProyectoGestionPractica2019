<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    protected $primaryKey = 'id_practica';

    protected $fillable = [
        'f_solicitud','f_inscripcion','f_desde','f_hasta','asist_ch_post_pract','asist_ch_pre_pract','id_alumno','id_supervisor'
    ];

    public function alumno(){
        return $this->hasMany('App\Alumno');
    }
    public function supervisor(){
        return $this->hasMany('App\Supervisor');
    }
    public function registroContacto(){
        return $this->hasOne('App\RegistroContacto');
    }
    public function resolucion(){
        return $this->hasOne('App\Resolucion');
    }
    public function evaluacionSupervisor(){
        return $this->hasOne('App\EvaluacionSupervisor');
    }
    public function autoevaluacion(){
        return $this->hasOne('App\Autoevaluacion');
    }
}
