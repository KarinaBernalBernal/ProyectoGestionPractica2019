<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\DeclareDeclare;

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

    public static function filtrar($buscador, $nombre, $apellido_paterno, $apellido_materno, $rut, $anno_ingreso, $carrera, $estado, $resolucion_solicitud)
    {
        return Solicitud::Buscador($buscador)
            ->Nombre($nombre)
            ->ApellidoPaterno($apellido_paterno)
            ->ApellidoMaterno($apellido_materno)
            ->Rut($rut)
            ->AnnoIngreso($anno_ingreso)
            ->Carrera($carrera)
            ->Estado($estado)
            ->ResolucionSolicitud($resolucion_solicitud)
            ->orderBy('id_solicitud', 'ASC')
            ->get();
    }

    public static function filtrarSolicitudP($buscador, $nombre, $apellido_paterno, $apellido_materno, $rut, $anno_ingreso, $carrera, $estado, $practica)
    {
        return Solicitud::Buscador($buscador)
            ->Nombre($nombre)
            ->ApellidoPaterno($apellido_paterno)
            ->ApellidoMaterno($apellido_materno)
            ->Rut($rut)
            ->AnnoIngreso($anno_ingreso)
            ->Carrera($carrera)
            ->Estado($estado)
            ->Practica($practica)
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
                ->orwhere('estado', 'LIKE', '%'. $buscador . '%')
                ->orwhere('resolucion_solicitud', 'LIKE', '%'. $buscador . '%')
                ->orwhere('practica', 'LIKE', '%'. $buscador . '%');
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

    public static function filtrarSolicitudGestionador($rut, $carrera, $anno_ingreso, $resolucion_solicitud, $f_solicitud)
    {
        $solicitudes = DB::table('solicitudes')
            ->where('rut', 'LIKE', '%'.$rut. '%')
            ->where('carrera', 'LIKE', '%'.$carrera. '%')
            ->where('anno_ingreso', 'LIKE', '%'.$anno_ingreso. '%')
            ->where('resolucion_solicitud', 'LIKE', '%'.$resolucion_solicitud. '%')
            ->where('f_solicitud', 'LIKE', '%'.$f_solicitud. '%')
            ->select('solicitudes.*')
            ->get();

        return $solicitudes;
    }

    public function scopeResolucionSolicitud($query, $resolucion_solicitud){

        if (  trim($resolucion_solicitud !== '') ) {
            $query->where('resolucion_solicitud', 'LIKE', '%'. $resolucion_solicitud . '%');
        }
        return $query;
    }

    public function scopePractica($query, $practica){

        if (  trim($practica !== '') ) {
            $query->where('practica', 'LIKE', '%'. $practica . '%');
        }
        return $query;
    }
}
