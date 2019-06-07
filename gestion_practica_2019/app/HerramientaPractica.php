<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class HerramientaPractica extends Model
{
    protected $fillable = [
       	'id_autoeval','id_herramienta'
    ];

    public function autoevaluacion(){
 		return $this->hasMany('App\Autoevaluacion');
    }
    public function herramienta(){
 		return $this->belongsTo('App\Herramienta');
    }
}
