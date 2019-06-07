<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class DocSolicitado extends Model
{
    protected $primaryKey = 'id_doc_solicitado';

    protected $fillable = [
        'f_solicitud','carta_presentacion','seguro_escolar','f_desde','f_hasta','n_destinatario','cargo','departamento','cuidad','empresa','id_alumno'
    ];
    public function alumno(){
 		return $this->hasMany('App\Alumno');
    }
}
