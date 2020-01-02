<?php

namespace SGPP\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use SGPP\Alumno;
use SGPP\DocSolicitado;
use SGPP\Practica;
use SGPP\User;
use SGPP\Supervisor;
use SGPP\Empresa;
use SGPP\Solicitud;
use Illuminate\Support\Facades\DB;
use Mail;

class InscripcionController extends Controller
{
    /* ----- Solicitar Documentos ----*/

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_administrador')->only('lista', 'listaInscripcionCivil', 'listaInscripcionEjecucion');
        $this->middleware('is_alumno')->except('lista', 'listaInscripcionCivil', 'listaInscripcionEjecucion', 'solicitudDocumentosModal','aviso', 'borrarSolicitud');
    }
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
        $solicitud = Solicitud::all()
            ->where('rut', $alumno->rut)
            ->where("carrera",$alumno->carrera)->first();
        $empresa = Empresa::where('rut',$request->rutEmpresa)->first();
        if($empresa == null)
        {
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
        if($supervisor == null)
        {
            User::create([
                'name' => $request->nombreSupervisor,
                'email' => $request->emailSupervisor,
                'password' => str_random(8),
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
        if($practica == null) //Si el alumno no posee ninguna practica
        {
            Practica::create([
                'f_solicitud' => $fecha,
                'f_inscripcion' => $fecha,
                'f_desde' => $request->fechaDesde,
                'f_hasta' => $request->fechaHasta,
                'id_alumno' => $alumno->id_alumno,
                'id_supervisor' => $supervisor->id_supervisor,
            ]);
        }
        else {  //Si el alumno tiene la practica (pero sin los datos completos) REVISAR
            $practica->f_inscripcion = $fecha;
            $practica->f_desde = $request->fechaDesde;
            $practica->f_hasta = $request->fechaHasta;
            $practica->id_supervisor = $supervisor->id_supervisor;

            $practica->save();
        }
        //Con esto evitamos que aquellas solicitudes de alumnos que estén en práctica, puedan ser modificadas y
        //asi evitar que la practica pueda ser eliminada.
        $solicitud->estado = 3;
        return redirect()->route('descripcionInscripcion');
    }

    public function lista()
    {
        $lista = DB::table('documentos_solicitados')
            ->join('alumnos', 'alumnos.id_alumno', 'documentos_solicitados.id_alumno')
            ->join('solicitudes', 'solicitudes.id_alumno', 'alumnos.id_alumno')
            ->select('documentos_solicitados.*', 'alumnos.*', 'solicitudes.resolucion_solicitud')
            ->get();
        return view('2 Inscripcion/lista_solicitudes_documentos',[
                'lista'=>$lista,
            ]);
    }

    /* ----- Inscripcion practica ----*/

    public function verDescripcionSolicitudDoc(){
        return view('2 Inscripcion/solicitudDocumentos');
    }

    public function verDescripcionInscripcion()
    {
        $id = auth()->user()->id_user;
        $alumnos = Alumno::where('id_user', $id)->first();

        $practicas = DB::table('practicas')
            ->join('alumnos', 'alumnos.id_alumno', '=','practicas.id_alumno')
            ->join('supervisores', 'supervisores.id_supervisor', '=', 'practicas.id_supervisor')
            ->leftJoin('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->where('practicas.id_alumno', '=', $alumnos->id_alumno)
            ->select('practicas.*', 'supervisores.nombre', 'supervisores.apellido_paterno', 'supervisores.email', 'resoluciones.resolucion_practica')
            ->get();

        //Se retornan las practicas asociadas al alumno, el supervisor asociado a cada practica y el estado de la practica

        return view('2 Inscripcion/inscripcion')
            ->with('practica', $practicas)
            ->with('alumno', $alumnos);
    }

    /* -------Listas de inscripcion -----*/
    public function solicitudDocumentosModal($id)
    {
        $solicitudD = DB::table('documentos_solicitados')
            ->join('alumnos', 'alumnos.id_alumno', 'documentos_solicitados.id_alumno')
            ->join('solicitudes', 'solicitudes.id_alumno', 'alumnos.id_alumno')
            ->where('documentos_solicitados.id_doc_solicitado', $id)
            ->select('documentos_solicitados.*', 'alumnos.*', 'solicitudes.resolucion_solicitud')
            ->get();


        return view('2 Inscripcion/modales/modalSolicitudDocumentos',[
            'solicitudD'=>$solicitudD,
        ]);
    }
    public function aviso(Request $request)
    {
        $alumno = Alumno::find($request->id);
        $subject = "Carta presentación/Seguro escolar";
        $for = $alumno->email;
        Mail::send('Emails.solicitudDocumentos', $request->all(), function($msj) use($subject,$for){
            $msj->from("practicaprofesionalpucv@gmail.com","Docencia Escuela de Ingeniería Informática");
            $msj->subject($subject);
            $msj->to($for);
        });
    }
    public function borrarSolicitud($id_elemento)
    {
        $elemento_eliminar =  DocSolicitado::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_solicitudes_documentos');
    }

    public function listaInscripcion(Request $request, $carrera)
    {
        $alumnosInformatica = DB::table('alumnos')
            ->join('practicas', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
            ->where('alumnos.carrera', '=', $carrera)
            ->where('practicas.f_inscripcion', '!=', null)
            ->select('alumnos.*', 'practicas.*')
            ->get();

        if ($request->nombre != null || $request->apellido_paterno != null || $request->rut != null || $request->f_inscripcion != null)
        {
            //-----Filtro-----//
            $listaFiltrada= Alumno::filtrarFechaPractica(
                $request->get('nombre'),
                $request->get('apellido_paterno'),
                $request->get('rut'),
                $request->get('f_inscripcion'),
                $carrera
            );
            $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
            $listaFiltrada = $listaFiltrada->paginate(7);
            return view('2 Inscripcion/listaInscripcion')->with('alumnos',$listaFiltrada)
                ->with('contador',$contador)
                ->with('carrera', $carrera);
        }
        $contador = $alumnosInformatica->count();
        $alumnosInformatica = $alumnosInformatica->paginate(7);
        return view('2 Inscripcion/listaInscripcion')->with('alumnos',$alumnosInformatica)
            ->with('contador', $contador)
            ->with('carrera', $carrera);
    }   
}

