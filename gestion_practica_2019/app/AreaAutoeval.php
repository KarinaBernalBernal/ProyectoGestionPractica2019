<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class AreaAutoeval extends Model
{
    protected $table = 'areas_autoeval';
    protected $fillable = [
       	'id_autoeval','id_area', 'eleccion'
    ];

    public function autoevaluacion(){
 		return $this->hasMany('App\Autoevaluacion');
    }
    public function area(){
 		return $this->hasMany('App\Area');
    }
}
