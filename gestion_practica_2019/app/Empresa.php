<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'id_empresa','n_empresa','rut','ciudad','direccion','fono','casilla','email'
    ];
    public function supervisor(){
 		return $this->belongsTo('App\Supervisor');
    }
}
