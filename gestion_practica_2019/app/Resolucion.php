<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Resolucion extends Model
{
    protected $primaryKey = 'id_resolucion';
    protected $table = 'resoluciones';

    protected $fillable = [
       'f_resolucion','observacion_resolucion','resolucion_practica','id_practica','id_admin'
    ];

    public function admin(){
        return $this->hasMany('App\Administrador');
    }
    public function practica(){
       return $this->hasOne('App\Practica');
    }

    public static function filtrarResolucionP($nombre, $apellido_paterno, $rut, $carrera, $email)
    {
        $practicasP = DB::table('practicas')
            ->join('alumnos', 'alumnos.id_alumno', 'practicas.id_alumno')
            ->leftJoin('supervisores', 'supervisores.id_supervisor', 'practicas.id_supervisor')
            ->leftJoin('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->where('resoluciones.id_resolucion', NULL)
            ->where('practicas.f_inscripcion', '!=', NULL)
            ->where('alumnos.nombre', 'LIKE', '%'.$nombre. '%')
            ->where('alumnos.apellido_paterno', 'LIKE', '%'.$apellido_paterno. '%')
            ->where('alumnos.rut', 'LIKE', '%'.$rut. '%')
            ->where('alumnos.carrera', 'LIKE', '%'.$carrera. '%')
            ->where('supervisores.email', 'LIKE', '%'.$email. '%')
            ->select('practicas.*', 'alumnos.rut', 'alumnos.nombre AS nombreAlumno', 'alumnos.apellido_paterno AS apellidoAlumno', 'supervisores.nombre', 'supervisores.apellido_paterno', 'supervisores.email AS emailSupervisor')
            ->get();

        return $practicasP;
    }

    public static function filtrarResolucionE($nombre, $apellido_paterno, $rut, $carrera, $email)
    {
        $practicasE = DB::table('practicas')
            ->join('alumnos', 'alumnos.id_alumno', 'practicas.id_alumno')
            ->leftJoin('supervisores', 'supervisores.id_supervisor', 'practicas.id_supervisor')
            ->join('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->where('practicas.f_inscripcion', '!=', NULL)
            ->where('alumnos.nombre', 'LIKE', '%'.$nombre. '%')
            ->where('alumnos.apellido_paterno', 'LIKE', '%'.$apellido_paterno. '%')
            ->where('alumnos.rut', 'LIKE', '%'.$rut. '%')
            ->where('alumnos.carrera', 'LIKE', '%'.$carrera. '%')
            ->where('supervisores.email', 'LIKE', '%'.$email. '%')
            ->select('practicas.*', 'alumnos.rut', 'alumnos.nombre AS nombreAlumno', 'alumnos.apellido_paterno AS apellidoAlumno', 'supervisores.nombre', 'supervisores.apellido_paterno', 'resoluciones.resolucion_practica', 'resoluciones.f_resolucion', 'supervisores.email AS emailSupervisor')
            ->get();

        return $practicasE;
    }

}
