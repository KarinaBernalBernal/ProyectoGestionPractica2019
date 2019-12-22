<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;

class OtrosAreas extends Model
{
    protected $primaryKey = 'id_otro_area';

    protected $fillable = [
        'n_area'
    ];
}
