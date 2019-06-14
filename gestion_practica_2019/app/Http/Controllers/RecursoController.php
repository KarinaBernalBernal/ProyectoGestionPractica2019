<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Recurso;

class RecursoController extends Controller
{
    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Recurso::all();
        return view('lista_recursos',[
                'lista'=>$lista,
            ]);
    }

}