<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




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

    //----------------FILTROS------------

    public static function filtrarSupervisoresEnPractica($nombre, $apellido_paterno, $email, $fono, $carrera)
    {
        $supervisoresFiltrados = DB::table('supervisores')
            ->join('practicas', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
            ->join('alumnos', 'alumnos.id_alumno', '=', 'practicas.id_alumno')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->where('practicas.f_inscripcion', '!=', null)
            ->where('supervisores.nombre', 'LIKE', '%'.$nombre. '%')
            ->where('supervisores.apellido_paterno', 'LIKE', '%'.$apellido_paterno. '%')
            ->where('supervisores.email', 'LIKE', '%'.$email. '%')
            ->where('supervisores.fono', 'LIKE', '%'.$fono. '%')
            ->where('carrera', 'LIKE', '%'.$carrera. '%')
            ->select('supervisores.*', 'evaluaciones_supervisor.*', 'alumnos.nombre as nombre_alumno', 'alumnos.apellido_paterno as apellido_alumno')
            ->get();

        return $supervisoresFiltrados;
    }

    public static function filtrarYPaginar($buscador, $nombre, $apellido_paterno,$email)
    {
        return Supervisor::Buscador($buscador)
            ->Nombre($nombre)
            ->ApellidoPaterno($apellido_paterno)
            ->Email($email)
            ->orderBy('id_supervisor', 'ASC')
            ->paginate();
    }

    public function scopeBuscador($query, $buscador)
    {
        if (  trim($buscador !== '') )
        {
            $query->where('nombre', 'LIKE', '%'. $buscador . '%')
                ->orwhere('apellido_paterno', 'LIKE', '%'. $buscador . '%')
                ->orwhere('email', 'LIKE', '%'. $buscador . '%');
        }
        return $query;
    }

    public function scopeNombre($query, $nombre)
    {
        if (  trim($nombre !== '') )
        {
            $query->where('nombre', 'LIKE', '%'. $nombre . '%');
        }
        return $query;
    }

    public function scopeApellidoPaterno($query, $apellido_paterno)
    {
        if (  trim($apellido_paterno !== '') )
        {
            $query->where('apellido_paterno', 'LIKE', '%'. $apellido_paterno . '%');
        }
        return $query;
    }

    public function scopeEmail($query, $email)
    {
        if (  trim($email !== '') )
        {
            $query->where('email', 'LIKE', '%'. $email . '%');
        }
        return $query;
    }
}
