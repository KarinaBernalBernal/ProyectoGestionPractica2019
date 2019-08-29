<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Solicitud;
use SGPP\DocumentoSolicitado;
use SGPP\Alumno;
use Auth;


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

        $fecha = date("Y-m-d H:i:s");
        $user_id = Auth::user()->id_user;
        $alumno = Alumno::where('id_user', $user_id)->first();
        $data = $request->all();

        $nuevo = new DocumentoSolicitado;

        $nuevo->f_solicitud = $fecha;
        if(isset($data['cartaPresentacion'])){
            $nuevo->carta_presentacion = true;
        }
        else{
            $nuevo->carta_presentacion = false;
        }

        if(isset($data['seguroEscolar'])){
            $nuevo->seguro_escolar = true;
        }
        else{
            $nuevo->seguro_escolar = false;
        }
        $nuevo->f_desde = $data['fechaDesde'];
        $nuevo->f_hasta = $data['fechaHasta'];
        $nuevo->n_destinatario = $data['n_destinatario'];
        $nuevo->cargo = $data['cargo'];
        $nuevo->departamento = $data['departamento'];
        $nuevo->cuidad = $data['ciudad'];
        $nuevo->empresa = $data['empresa'];
        $nuevo->id_alumno = $alumno->id_alumno;
        $nuevo->save();

        // *falta guardar la fecha en practica


        return redirect()->route('descripcionSolicitudDocumentos');
    }
    public function storeInscripcion(Request $request)
    {
        return redirect()->route('descripcionInscripcion');
    }

    public function lista()
    {
        $lista=DocumentoSolicitado::all();
        return view('2 Inscripcion/lista_solicitudes_documentos',[
                'lista'=>$lista,
            ]);
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