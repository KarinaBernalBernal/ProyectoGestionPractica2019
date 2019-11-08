<?php

namespace SGPP\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use PHPUnit\Framework\Warning;
use SGPP\Alumno;
use SGPP\DocSolicitado;
use SGPP\Practica;
use SGPP\User;
use SGPP\Supervisor;
use SGPP\Empresa;
use SGPP\Solicitud;



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

        $usuario_id = Auth()->user()->id_user;
        $alumno = Alumno::where('id_user',$usuario_id)->first();
        
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
            'id_alumno' => $alumno->id_alumno
        ]);

        /*falta guardar la fecha en practica
        */

        return redirect()->route('descripcionSolicitudDocumentos');
    }
    public function storeInscripcion(Request $request)
    {
        $fecha = date("Y-m-d");

        $usuario_id = Auth()->user()->id_user;
        $alumno = Alumno::where('id_user',$usuario_id)->first();
        $practica = Practica::where('id_alumno',$alumno->id_alumno)->first();
        
        $empresa = Empresa::where('rut',$request->rutEmpresa)->first();
        if($empresa == null){
            Empresa::create([
                'n_empresa' => $request->empresa,
                'rut' => $request->rutEmpresa,
                'ciudad' => $request->ciudad,
                'direccion' => $request->direccion,
                'fono' => $request->fono,
                'casilla' => $request->casilla,
                'email' => $request->email
            ]);
            $empresa = Empresa::where('rut',$request->rutEmpresa)->first();
        }
        
        $supervisor = Supervisor::where('email',$request->emailSupervisor)->first();
        if($supervisor == null){
            User::create([
                'name' => $request->nombreSupervisor,
                'email' => $request->emailSupervisor,
                'password' => bcrypt('supervisor123'), //str_random(8) Para el value
                'type' => 'Supervisor'
            ]);
            $usuarioS = User::where('email',$request->emailSupervisor)->first();

            Supervisor::create([
                'nombre' => $request->nombreSupervisor,
                'apellido_paterno' => $request->aPaternoSupervisor,
                'cargo' => $request->cargo,
                'departamento' => $request->departamento,   
                'email' => $request->emailSupervisor, 
                'fono' => $request->fonoSupervisor,   
                'id_user' => $usuarioS->id_user,     
                'id_empresa' => $empresa->id_empresa     
            ]);
            $supervisor = Supervisor::where('email',$request->emailSupervisor)->first();
        }

        $practica = Practica::where('id_alumno',$alumno->id_alumno)->first();
        if($practica == null)
        {
            Practica::create([
                'f_solicitud' => $fecha,
                'f_inscripcion' => $fecha,
                'f_desde' => $request->fechaDesde,
                'f_hasta' => $request->fechaHasta,
                'id_alumno' => $alumno->id_alumno,
                'id_supervisor' => $supervisor->id_supervisor,
            ]);
            $practica = Practica::where('id_alumno',$alumno->id_alumno)->first();
        }
        return redirect()->route('descripcionInscripcion');
    }

    public function lista()
    {
        $lista=DocSolicitado::all();
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

    /* -------Listas de inscripcion -----*/
    public function listaInscripcionCivil(){
        $practicas = Practica::orderBy('id_alumno','DESC')->paginate(7);
        $alumnos = Alumno::orderBy('id_alumno','DESC')->where('carrera', 'Ingeniería Civil Informática')->paginate(7);

        return view('2 Inscripcion/listaInscripcion')->with('practicas', $practicas)->with('alumnos',$alumnos);
    }   
    public function listaInscripcionEjecucion(){
        $practicas = Practica::orderBy('id_alumno','DESC')->paginate(7);
        $alumnos = Alumno::orderBy('id_alumno','DESC')->where('carrera', 'Ingeniería de Ejecución Informática')->paginate(7);

        return view('2 Inscripcion/listaInscripcion')->with('practicas', $practicas)->with('alumnos',$alumnos);
    }   
}

?>