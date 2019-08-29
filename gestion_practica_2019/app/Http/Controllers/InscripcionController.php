<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SGPP\DocSolicitado;

class InscripcionController extends Controller
{
    /* ----- Solicitar Documentos ----*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSolicitarDocumentos()
    {

        return view('2 Inscripcion/formularioSolicitarDocumentos');

    }

    public function indexInscripcion()
    {
        return view('2 Inscripcion/formularioInscripcion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function storeSolicitarDocumentos(Request $request)
    {
        $fecha = date("Y-m-d");

        if($request->cartaPresentacion == 'on')
            $request->cartaPresentacion = true;
        else 
            $request->cartaPresentacion = false;


        if($request->seguroEscolar == 'on')
            $request->seguroEscolar = true;
        else 
            $request->seguroEscolar = false;


        DocSolicitado::create([
            
            'f_solicitud' => $fecha,
            'carta_presentacion' => $request->cartaPresentacion,
            'seguro_escolar' => $request->seguroEscolar,
            'f_desde' => $request->fechaDesde,
            'f_hasta' => $request->fechaHasta,
            'n_destinatario' => $request->n_destinatario,
            'cargo' => $request->cargo,
            'departamento' => $request->departamento,
            'ciudad' => $request->ciudad,
            'empresa' => $request->empresa,
            
            'id_alumno' => Auth::id()
        ]);

        return redirect()->route('descripcionSolicitudDocumentos');
    }
    public function storeInscripcion(Request $request)
    {
        return redirect()->route('descripcionInscripcion');
    }

    /* ----- Inscripcion practica ----*/

    public function verDescripcionSolicitudDoc(){
        return view('2 Inscripcion/solicitudDocumentos');
    }

    public function verDescripcionInscripcion(){
        return view('2 Inscripcion/inscripcion');
    }

    
}

?>