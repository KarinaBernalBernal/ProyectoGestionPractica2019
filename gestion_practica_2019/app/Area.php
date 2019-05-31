<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $primaryKey = 'id_area';

    protected $fillable = [
       	'n_area'
    ];

    public function areaAutoeval(){
 		return $this->belongsTo('App\AreaAutoeval');
    }
    public function areaEvaluacion(){
 		/return $this->belongsTo('App\AreaEvaluacion');
    }
}
