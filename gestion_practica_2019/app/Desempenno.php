<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Desempenno extends Model
{
    protected $fillable = [
          	'id_autoeval','valor','dp_desempenno'
	];
    public function autoevaluacion(){
 		return $this->belongsTo('App\User');
    }
}
