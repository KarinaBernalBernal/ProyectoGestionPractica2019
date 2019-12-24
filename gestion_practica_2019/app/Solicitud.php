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

    public static function filtrar($buscador, $nombre, $apellido_paterno, $apellido_materno, $rut, $anno_ingreso, $carrera, $estado)
    {

        return Solicitud::Buscador($buscador)
            ->Nombre($nombre)
            ->ApellidoPaterno($apellido_paterno)
            ->ApellidoMaterno($apellido_materno)
            ->Rut($rut)
            ->AnnoIngreso($anno_ingreso)
            ->Carrera($carrera)
            ->Estado($estado)
            ->orderBy('id_solicitud', 'ASC')
            ->get();
    }

    public function scopeBuscador($query, $buscador){

        if (  trim($buscador !== '') ) {
            $query->where('nombre', 'LIKE', '%'. $buscador . '%')
                ->orwhere('apellido_paterno', 'LIKE', '%'. $buscador . '%')
                ->orwhere('apellido_materno', 'LIKE', '%'. $buscador . '%')
                ->orwhere('rut', 'LIKE', '%'. $buscador . '%')
                ->orwhere('carrera', 'LIKE', '%'. $buscador . '%')
                ->orwhere('rut', 'LIKE', '%'. $buscador . '%')
                ->orwhere('anno_ingreso', 'LIKE', '%'. $buscador . '%')
                ->orwhere('carrera', 'LIKE', '%'. $buscador . '%')
                ->orwhere('estado', 'LIKE', '%'. $buscador . '%');
        }
        return $query;
    }

    public function scopeNombre($query, $nombre){

        if (  trim($nombre !== '') ) {
            $query->where('nombre', 'LIKE', '%'. $nombre . '%');
        }
        return $query;
    }

    public function scopeApellidoPaterno($query, $apellido_paterno){

        if (  trim($apellido_paterno !== '') ) {
            $query->where('apellido_paterno', 'LIKE', '%'. $apellido_paterno . '%');
        }
        return $query;
    }

    public function scopeApellidoMaterno($query, $apellido_materno){

        if (  trim($apellido_materno !== '') ) {
            $query->where('apellido_materno', 'LIKE', '%'. $apellido_materno . '%');
        }
        return $query;
    }

    public function scopeRut($query, $rut){

        if (  trim($rut !== '') ) {
            $query->where('rut', 'LIKE', '%'. $rut . '%');
        }
        return $query;
    }

    public function scopeAnnoIngreso($query, $anno_ingreso){

        if (  trim($anno_ingreso !== '') ) {
            $query->where('anno_ingreso', 'LIKE', '%'. $anno_ingreso . '%');
        }
        return $query;
    }

    public function scopeCarrera($query, $carrera){

        if (  trim($carrera !== '') ) {
            $query->where('carrera', 'LIKE', '%'. $carrera . '%');
        }
        return $query;
    }

    public function scopeEstado($query, $estado){

        if (  trim($estado !== '') ) {
            $query->where('estado', 'LIKE', '%'. $estado . '%');
        }
        return $query;
    }

}
