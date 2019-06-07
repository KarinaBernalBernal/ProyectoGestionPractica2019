<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $primaryKey = 'id_tarea';

    protected $fillable = [
        'n_tarea','dp_tarea','id_autoeval'
    ];

    public function autoevaluacion(){
        return $this->hasMany('App\Autoevaluacion');
    }
}
