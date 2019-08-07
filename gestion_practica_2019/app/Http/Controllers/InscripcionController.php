<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\DocSolicitados;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function storeSolicitarDocumentos(Request $request)
    {
        /*
        $fecha = date("Y-m-d H:i:s");
        $alumno =

        DocSolicitados::create(

            'f_solicitud' => $fecha,
            'carta_presentacion' => $request->cartaPresentacion,
            'seguro_escolar' => $request->seguroEscolar,
            'f_desde' => $request->fechaDesde,
            'f_hasta' => $request->fechaHasta,
            'n_destinatario' => $request->n_destinatario,
            'cargo' => $request->cargo,
            'departamento' => $request->departamento,
            'cuidad' => $request->ciudad,
            'empresa' => $request->empresa,
            'id_alumno' => 
        ]);
        */

        return redirect()->route('descripcionSolicitud');
    }

    /* ----- Inscripcion practica ----*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function verDescripcion(){
        return view('2 Inscripcion/solicitudDocumentos');
    }
}

?>