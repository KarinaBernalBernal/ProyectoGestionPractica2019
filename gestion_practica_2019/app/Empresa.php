<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $primaryKey = 'id_empresa';

    protected $fillable = [
        'n_empresa','rut','ciudad','direccion','fono','casilla','email'
    ];
    public function supervisor(){
 		return $this->belongsTo('App\Supervisor');
    }
}
