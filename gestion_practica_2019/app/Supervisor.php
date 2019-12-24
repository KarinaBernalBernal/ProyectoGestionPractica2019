<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;




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
