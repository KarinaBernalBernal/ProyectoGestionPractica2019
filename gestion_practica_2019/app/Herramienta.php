<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    protected $primaryKey = 'id_herramienta';

    protected $fillable = [
       	'n_herramienta'
    ];

    public function herramientaPractica(){
 		return $this->belongsTo('App\HerramientaPractica');
    }
}
