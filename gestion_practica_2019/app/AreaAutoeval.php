<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class AreaAutoeval extends Model
{
    protected $fillable = [
       	'id_autoeval','id_area'
    ];

    public function autoevaluacion(){
 		return $this->hasMany('App\Autoevaluacion');
    }
    public function area(){
 		return $this->hasMany('App\Area');
    }
}
