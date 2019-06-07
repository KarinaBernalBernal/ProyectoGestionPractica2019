<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Conocimiento extends Model
{
    protected $primaryKey = 'id_conocimiento';

    protected $fillable = [
        'n_conocimiento','dp_conocimiento','tipo_conocimiento','id_autoeval'
    ];

    public function autoevaluacion(){
        return $this->hasMany('App\Autoevaluacion');
    }
}
