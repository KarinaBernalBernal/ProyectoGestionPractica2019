<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    protected $table = 'habilidades';
    protected $primaryKey = 'id_habilidad';

    protected $fillable = [
        'n_habilidad','dp_habilidad','tipo_habilidad','id_autoeval'
    ];

    public function autoevaluacion(){
        return $this->hasMany('App\Autoevaluacion');
    }
}
