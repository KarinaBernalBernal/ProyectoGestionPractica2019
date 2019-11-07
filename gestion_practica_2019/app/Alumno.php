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

    public static function filtrarYPaginar($buscador, $nombre, $apellido_paterno, $apellido_materno, $email, $anno_ingreso, $carrera){
        return Alumno::Buscador($buscador)
                    ->Nombre($nombre)
                    ->ApellidoPaterno($apellido_paterno)
                    ->ApellidoMaterno($apellido_materno)
                    ->Email($email)
                    ->AnnoIngreso($anno_ingreso)
                    ->Carrera($carrera)
                    ->orderBy('id_alumno', 'ASC')
                    ->paginate();
    }

    public function scopeBuscador($query, $buscador){

        if (  trim($buscador !== '') ) {
            $query->where('nombre', 'LIKE', '%'. $buscador . '%')
                    ->orwhere('apellido_paterno', 'LIKE', '%'. $buscador . '%')
                    ->orwhere('apellido_materno', 'LIKE', '%'. $buscador . '%')
                    ->orwhere('email', 'LIKE', '%'. $buscador . '%')
                    ->orwhere('carrera', 'LIKE', '%'. $buscador . '%')
                    ->orwhere('rut', 'LIKE', '%'. $buscador . '%')
                    ->orwhere('anno_ingreso', 'LIKE', '%'. $buscador . '%')
                    ->orwhere('direccion', 'LIKE', '%'. $buscador . '%');
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

    public function scopeEmail($query, $email){

        if (  trim($email !== '') ) {
			$query->where('email', 'LIKE', '%'. $email . '%');
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
}