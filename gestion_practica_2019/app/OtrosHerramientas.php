<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class OtrosHerramientas extends Model
{
    protected $primaryKey = 'id_otro_herramienta';

    protected $fillable = [
        'n_herramienta'
    ];
}
