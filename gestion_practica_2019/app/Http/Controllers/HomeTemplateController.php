<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;

class HomeTemplateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //HOME NO PUEDE SER VISTO POR GENTE SIN SESIÓN ACTIVA, USAR "guest" es una solución
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home2');
    }
}
