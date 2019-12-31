<?php

namespace SGPP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empresa extends Model
{
    protected $primaryKey = 'id_empresa';

    protected $fillable = [
        'n_empresa','rut','ciudad','direccion','fono','casilla','email'
    ];
    public function supervisor(){
 		return $this->belongsTo('App\Supervisor');
    }

    public static function filtrarEmpresa($nombre, $rut, $ciudad, $direccion, $email)
    {
        $empresasFiltradas = DB::table('empresas')
            ->where('n_empresa', 'LIKE', '%'.$nombre. '%')
            ->where('rut', 'LIKE', '%'.$rut. '%')
            ->where('ciudad', 'LIKE', '%'.$ciudad. '%')
            ->where('direccion', 'LIKE', '%'.$direccion. '%')
            ->where('email', 'LIKE', '%'.$email. '%')
            ->select('empresas.*')
            ->get();

        return $empresasFiltradas;
    }



}
