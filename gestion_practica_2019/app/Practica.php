<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    protected $primaryKey = 'id_practica';

    protected $fillable = [
        'f_solicitud','f_inscripcion','f_desde','f_hasta','asist_ch_post_pract','id_alumno','id_supervisor'
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

    public function scopeBuscador($query, $buscador)
    {
        if (  trim($buscador !== '') )
        {
            $query->where('f_inscripcion', 'LIKE', '%'. $buscador . '%');
        }
        return $query;
    }

    public function scopeFechaInscripcion($query, $f_inscripcion)
    {
        if (  trim($f_inscripcion !== '') )
        {
            $query->where('f_inscripcion', 'LIKE', '%'. $f_inscripcion . '%');
        }
        return $query;
    }

}
