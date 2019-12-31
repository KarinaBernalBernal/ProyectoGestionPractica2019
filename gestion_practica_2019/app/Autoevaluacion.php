<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Autoevaluacion extends Model
{
    protected $primaryKey = 'id_autoeval';
    protected $table = 'autoevaluaciones';

    protected $fillable = [
       	'f_entrega','id_practica'
    ];

    public function practica(){
 		return $this->belongsTo('App\User');
    }
    public function desempenno(){
 		return $this->hasOne('App\Desempenno');
    }
    public function tarea(){
 		return $this->belongsTo('App\Tarea');
    }
    public function habilidad(){
 		return $this->belongsTo('App\Habilidad');
    }
    public function conocimiento(){
 		return $this->belongsTo('App\Conocimiento');
    }
    public function herramientaPractica(){
 		return $this->belongsTo('App\HerramientaPractica');
    }
    public function areaAutoeval(){
 		return $this->belongsTo('App\AreaAutoeval');
    }
    public function evalActPractica(){
 		return $this->belongsTo('App\EvalActPractica');
    }
    public function evalConPractica(){
 		return $this->belongsTo('App\EvalConPractica');
    }

    public function scopeBuscador($query, $buscador)
    {
        if (  trim($buscador !== '') )
        {
            $query->where('f_entrega', 'LIKE', '%'. $buscador . '%');
        }
        return $query;
    }

    public function scopeFechaEntrega($query, $f_entrega)
    {
        if (  trim($f_entrega !== '') )
        {
            $query->where('f_entrega', 'LIKE', '%'. $f_entrega . '%');
        }
        return $query;
    }

    public static function filtrarAutoevaluacion($f_entrega,$rut)
    {
        $autoevaluacionesFiltradas = DB::table('autoevaluaciones')
            ->join('practicas', 'practicas.id_practica', '=', 'autoevaluaciones.id_practica')
            ->join('alumnos', 'alumnos.id_alumno', '=', 'practicas.id_alumno')
            ->where('f_entrega', 'LIKE', '%'.$f_entrega. '%')
            ->where('alumnos.rut', 'LIKE', '%'.$rut. '%')
            ->select('autoevaluaciones.*', 'alumnos.rut')
            ->get();

        return $autoevaluacionesFiltradas;
    }

}
