<?php
namespace SGPP\Http\Controllers;
use Illuminate\Http\Request;
use SGPP\Solicitud;
use SGPP\Alumno;
use SGPP\User;
use SGPP\Practica;
use Mail;
use Illuminate\Support\Facades\DB;

class SolicitudController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except('index', 'store', 'verDescripcion', 'contact');
        $this->middleware('is_administrador')->except('index', 'store', 'verDescripcion', 'contact');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('1 Solicitud/formularioSolicitud');
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
        $solicitudDuplicada = DB::table('solicitudes')
            ->where('solicitudes.rut', $request->rutAlumno)
            ->where('solicitudes.resolucion_solicitud', null)
            ->select('solicitudes.*')
            ->first();

        $solicitudEvaluada = DB::table('solicitudes')
            ->join('alumnos', 'alumnos.id_alumno', 'solicitudes.id_alumno')
            ->join('practicas', 'practicas.id_alumno', 'alumnos.id_alumno')
            ->where('solicitudes.rut', $request->rutAlumno)
            ->where('solicitudes.resolucion_solicitud', '!=', null)
            ->where('solicitudes.resolucion_solicitud', '!=', "Rechazada")
            ->where('practicas.f_inscripcion', null)
            ->select('solicitudes.*')
            ->first();

        $solicitudesEnPractica = DB::table('solicitudes')
            ->join('alumnos', 'alumnos.id_alumno', 'solicitudes.id_alumno')
            ->join('practicas', 'practicas.id_alumno', 'alumnos.id_alumno')
            ->join('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->where('solicitudes.rut', $request->rutAlumno)
            ->where('practicas.f_inscripcion', '!=', null)
            ->where('resoluciones.resolucion_practica', null)
            ->select('solicitudes.*')
            ->first();

        if( !$solicitudEvaluada && !$solicitudesEnPractica )
        {
            if(!$solicitudDuplicada)
            {
                $fecha = date("Y-m-d H:i:s");
                Solicitud::create([
                    'nombre' => $request->nombreAlumno,
                    'apellido_paterno' => $request->aPaternoAlumno,
                    'apellido_materno' => $request->aMaternoAlumno,
                    'rut' => $request->rutAlumno,
                    'email' => $request->email,
                    'direccion' => $request->direccion,
                    'fono' => $request->fono,
                    'anno_ingreso' => $request->añoCarrera,
                    'carrera' => $request->carrera,
                    'practica' => $request->practica,
                    'semestre_proyecto' => $request->semestreProyecto,
                    'anno_proyecto' => $request->añoProyecto,
                    'f_solicitud' => $fecha,
                    'resolucion_solicitud' => null,
                    'observacion_solicitud' => null
                ]);
                return redirect()->route('descripcionSolicitud');
            }
            else
            {
                //Borramos la vieja y ponemos la nueva solicitud

                $solicitudDuplicada = Solicitud::find($solicitudDuplicada->id_solicitud);
                $solicitudDuplicada->delete();

                $fecha = date("Y-m-d H:i:s");
                Solicitud::create([
                    'nombre' => $request->nombreAlumno,
                    'apellido_paterno' => $request->aPaternoAlumno,
                    'apellido_materno' => $request->aMaternoAlumno,
                    'rut' => $request->rutAlumno,
                    'email' => $request->email,
                    'direccion' => $request->direccion,
                    'fono' => $request->fono,
                    'anno_ingreso' => $request->añoCarrera,
                    'carrera' => $request->carrera,
                    'practica' => $request->practica,
                    'semestre_proyecto' => $request->semestreProyecto,
                    'anno_proyecto' => $request->añoProyecto,
                    'f_solicitud' => $fecha,
                    'resolucion_solicitud' => null,
                    'observacion_solicitud' => null
                ]);
                return redirect()->route('descripcionSolicitud'); //Solicitud reemplazante
            }
        }
        return redirect()->route('descripcionSolicitud'); //Solicitud reemplazante
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitudes = Solicitud::find($id);
        $solicitudes->delete();
        return redirect()->route('home');
    }

    //Este metodo no se está utilizando de momento ya que pertenecia a la verificacion del gestionador.
    public function estado($id)
    {
        $solicitudes = Solicitud::find($id);
        $solicitudes->estado = 1;
        $solicitudes->save();
        return redirect()->route('home');
    }
    /* ----------- Descripcion de Etapa ----------  */
    public function verDescripcion(){
        return view('1 Solicitud/solicitud');
    }
    /* ----------- Evaluacion de una Solicitud ----------  */
    // Civil
    /*
    public function evaluacion(){
        $solicitudesP = Solicitud::orderBy('rut','DESC')
            ->where('carrera', 'Ingeniería Civil Informática')
            ->where('estado',1)
            ->paginate(5);
    /* ----------- Validar una solicitud ----------  */
    public function listaSolicitudEjecucion( Request $request)
    {
        $solicitudes = DB::table('solicitudes')
            ->where('carrera', 'LIKE', '%'."Ingeniería de Ejecución Informática". '%')
            ->where('solicitudes.resolucion_solicitud', '!=', null)
            ->select('solicitudes.*')
            ->get();
        $contador = $solicitudes->count();
        $numeroSolicitudes = 0;

        if($request->rut != null || $request->anno_ingreso != null || $request->resolucion_solicitud != null || $request->f_solicitud != null)
        {
            //-----Filtro-----//
            $listaFiltrada= Solicitud::filtrarSolicitudGestionador(
                $request->get('rut'),
                "Ingeniería de Ejecución Informática",
                $request->get('anno_ingreso'),
                $request->get('resolucion_solicitud'),
                $request->get('f_solicitud')
            );
            $contador = $listaFiltrada->count();
            $listaFiltrada = $listaFiltrada->paginate(70);

            return view('1 Solicitud/listaSolicitudEjecucion')
                ->with('solicitudes',$listaFiltrada)
                ->with('contador',$contador)
                ->with('numeroSolicitudes', $numeroSolicitudes);
        }

        $solicitudes = $solicitudes->paginate(70);
        return view('1 Solicitud/listaSolicitudEjecucion')
            ->with('solicitudes', $solicitudes)
            ->with('contador', $contador)
            ->with('numeroSolicitudes', $numeroSolicitudes);
    }

    public function listaSolicitudCivil(Request $request)
    {
        $solicitudes = DB::table('solicitudes')
            ->where('carrera', 'LIKE', '%'."Ingeniería Civil Informática". '%')
            ->select('solicitudes.*')
            ->get();

        $contador = $solicitudes->count();
        $numeroSolicitudes = 0;

        if($request->rut != null || $request->anno_ingreso != null || $request->resolucion_solicitud != null || $request->f_solicitud != null)
        {
            $listaFiltrada= Solicitud::filtrarSolicitudGestionador(
                $request->get('rut'),
                "Ingeniería Civil Informática",
                $request->get('anno_ingreso'),
                $request->get('resolucion_solicitud'),
                $request->get('f_solicitud')
            );
            $contador = $listaFiltrada->count();
            $listaFiltrada = $listaFiltrada->paginate(100);

            return view('1 Solicitud/listaSolicitudCivil')
                ->with('solicitudes',$listaFiltrada)
                ->with('contador',$contador)
                ->with('numeroSolicitudes', $numeroSolicitudes);
        }

        $solicitudes = $solicitudes->paginate(100);
        return view('1 Solicitud/listaSolicitudCivil')
            ->with('solicitudes', $solicitudes)
            ->with('numeroSolicitudes', $numeroSolicitudes)
            ->with('contador', $contador);
    }
    /*---------------------------------------------------------------------------*/
    /* ----------- Evaluacion de una Solicitud  ----------  */
    public function evaluacion()
    {
         $solicitudesP = Solicitud::all()
            ->where('carrera', 'Ingeniería Civil Informática')
            ->where("estado",0);
        $solicitudesE = Solicitud::all()
            ->where('carrera', 'Ingeniería Civil Informática')
            ->where("estado",1);
        
        $carrera = 'Ingeniería Civil Informática';
        $contadorP = $solicitudesP->count();
        $contadorE = $solicitudesE->count();
        $solicitudesP = $solicitudesP->paginateEspecial(10, null, null, "pendiente");
        $solicitudesE = $solicitudesE->paginateEspecial(10, null, null, "evaluada");
       
        return view('1 Solicitud/evaluacionSolicitud',[
            'solicitudesP'=>$solicitudesP,
            'solicitudesE'=>$solicitudesE,
            'carrera'=>$carrera,
            'contadorP' => $contadorP,
            'contadorE' => $contadorE
        ]);
    }

    public function evaluacionEjecucion()
    {
        $solicitudesP = Solicitud::all()
            ->where('carrera', 'Ingeniería de Ejecución Informática')
            ->where("estado",0);
        $solicitudesE = Solicitud::all()
            ->where('carrera', 'Ingeniería de Ejecución Informática')
            ->where("estado",1);
        
        $carrera = "Ingeniería de Ejecución Informática";
        $contadorP = $solicitudesP->count();
        $contadorE = $solicitudesE->count();
        $solicitudesP = $solicitudesP->paginateEspecial(10, null, null, "pendiente");
        $solicitudesE = $solicitudesE->paginateEspecial(10, null, null, "evaluada");
        
        return view('1 Solicitud/evaluacionSolicitud',[
            'solicitudesP'=>$solicitudesP,
            'solicitudesE'=>$solicitudesE,
            'carrera'=>$carrera,
            'contadorP' => $contadorP,
            'contadorE' => $contadorE
        ]);
    }

    public function filtroSolicitudesP(Request $request, $carrera)
    {

        $solicitudesE = Solicitud::all()
            ->where('carrera', $carrera)
            ->where("estado",1);

        $contadorE = $solicitudesE->count();
        $solicitudesE = $solicitudesE->paginateEspecial(10, null, null, "evaluada");

        if( $carrera == "Ingeniería de Ejecución Informática")
        {
            //-----Filtro-----//
            $listaFiltrada = Solicitud::filtrarSolicitudP($request->get('buscador'),
                $request->get('nombre'),
                $request->get('apellido_paterno'),
                $request->get(null),
                $request->get('rut'),
                $request->get('anno_ingreso'),
                $carrera,
                0,
                ""
            );
        }
        else{
            //-----Filtro-----//
            $listaFiltrada = Solicitud::filtrarSolicitudP($request->get('buscador'),
                $request->get('nombre'),
                $request->get('apellido_paterno'),
                $request->get(null),
                $request->get('rut'),
                $request->get('anno_ingreso'),
                $carrera,
                0,
                $request->get('practica')
            );
        }

        $contadorP = $listaFiltrada->count();
        $listaFiltrada = $listaFiltrada->paginateEspecial(10, null, null, "pendiente");

        //Retorna los datos filtrados de la lista pendiente y la lista evaluada sin filtrar
        //Ademas retorna el tipo de carrera para diferenciar que la vista sea de civil y ejecucion
        //Finalmente retoran los contadores de las tablas para saber la cantidad de resultados/solicitudes

        return view('1 Solicitud/evaluacionSolicitud',[
            'solicitudesP'=>$listaFiltrada,
            'solicitudesE'=>$solicitudesE,
            'carrera' => $carrera,
            'contadorP' => $contadorP,
            'contadorE' => $contadorE
        ]);
    }

    public function filtroSolicitudesE(Request $request, $carrera)
    {

        $solicitudesP = Solicitud::all()
            ->where('carrera', $carrera)
            ->where("estado",0);

        $contadorP = $solicitudesP->count();
        $solicitudesP = $solicitudesP->paginate(10, null, null, "pendiente");

        //-----Filtro-----//
        $listaFiltrada = Solicitud::filtrar($request->get('buscador'),
            $request->get('nombre'),
            $request->get('apellido_paterno'),
            $request->get(null),
            $request->get('rut'),
            $request->get('anno_ingreso'),
            $carrera,
            1.,
            $request->get('resolucion_solicitud')
        );

        $contadorE = $listaFiltrada->count();
        $listaFiltrada = $listaFiltrada->paginate(10, null, null, "evaluada");

        //Retorna los datos filtrados de la lista evaluada y la lista pendiente sin filtrar
        //Ademas retorna el tipo de carrera para diferenciar que la vista sea de civil y ejecucion
        //Finalmente retoran los contadores de las tablas para saber la cantidad de resultados/solicitudes

        return view('1 Solicitud/evaluacionSolicitud',[
            'solicitudesP'=>$solicitudesP,
            'solicitudesE'=>$listaFiltrada,
            'carrera' => $carrera,
            'contadorP' => $contadorP,
            'contadorE' => $contadorE
        ]);
    }

    public function evaluarSolicitudModal($id){
        $solicitud=Solicitud::find($id);
        return view('1 Solicitud/modales/modalEvaluarSolicitud',[
            'solicitud'=>$solicitud
        ]);
    }

    public function modificarEvaluacionSolicitudModal($id){
        $solicitud=Solicitud::find($id);
        return view('1 Solicitud/modales/modalModificarEvaluacionSolicitud',[
            'solicitud'=>$solicitud
        ]);
    }
    /* Funciones modales */

    public function evaluarSolicitud(Request $request, $id)
    {
        $solicitud = Solicitud::find($id);

        if(!isset($solicitud))
        {
            return redirect()->route('home');
        }
        $solicitud->resolucion_solicitud = $request->resolucion;
        $solicitud->observacion_solicitud = $request->observacion;
        $solicitud->estado = 1;
        $solicitud->save();
        // si la solicitud es autorizada o pendiente, se crea el alumno y usuario del mismo
        if($solicitud->resolucion_solicitud == 'Autorizada' || $solicitud->resolucion_solicitud == 'Pendiente')
        {
            $alumno = Alumno::all()
                ->where('rut', $solicitud->rut)
                ->where("carrera",$solicitud->carrera)->first();
            $fecha= date("Y-m-d H:i:s");
            if($alumno == null)
            {
                $nuevo = new Alumno;
                $nuevo->nombre = $solicitud->nombre;
                $nuevo->apellido_paterno = $solicitud->apellido_paterno;
                $nuevo->apellido_materno = $solicitud->apellido_materno;
                $nuevo->rut = $solicitud->rut;
                $nuevo->email = $solicitud->email;
                $nuevo->direccion = $solicitud->direccion;
                $nuevo->fono = $solicitud->fono;
                $nuevo->anno_ingreso = $solicitud->anno_ingreso;
                $nuevo->carrera = $solicitud->carrera;
                $nuevo->semestre_proyecto = $solicitud->semestre_proyecto;
                $nuevo->anno_proyecto = $solicitud->anno_proyecto;
                $nueva_instancia = new User;
                $nueva_instancia->name = $nuevo->nombre;
                $nueva_instancia->email = $nuevo->email;
                $nueva_instancia->password = bcrypt($nuevo->rut);
                $nueva_instancia->type = 'Alumno';
                $nueva_instancia->save();
                $nuevo->id_user = $nueva_instancia->id_user;
                $nuevo->save();
                $solicitud->id_alumno = $nuevo->id_alumno;
                $solicitud->save();
                $nueva_instancia = new Practica;
                $nueva_instancia->f_solicitud = $fecha;
                $nueva_instancia->id_alumno = $nuevo->id_alumno;
                $nueva_instancia->save();

            }
            else {
                $nueva_instancia = new Practica;
                $nueva_instancia->f_solicitud = $fecha;
                $nueva_instancia->id_alumno = $alumno->id_alumno;
                $solicitud->id_alumno = $alumno->id_alumno;
                $solicitud->save();
                $nueva_instancia->save();
            }
        }
        // Se notifica al Alumno sobre el estado de su solicitud
/*POR MIENTRAS PARA NO ESTAR MANDANDO CORREOS A CADA RATO
        $subject = "Estado solicitud de práctica";
        $for = $solicitud->email;
        $data = [
            'solicitud' => $solicitud,
            'request'=> $request
        ];
        Mail::send('Emails.notificacion',$data, function($msj) use($subject,$for){
            $msj->from("practicaprofesionalpucv@gmail.com","Docencia Escuela de Ingeniería Informática");
            $msj->subject($subject);
            $msj->to($for);
        });
*/
        if($solicitud->carrera == "Ingeniería Civil Informática"){
            return redirect()->route('evaluacionSolicitud')->with('success','Registro creado satisfactoriamente');
        }
        else{
            return redirect()->route('evaluacionSolicitudEjecucion')->with('success','Registro creado satisfactoriamente');
        }
    }

    public function modificarEvaluacionSolicitud(Request $request, $id){
       $solicitud = Solicitud::find($id);
        if(!isset($solicitud))
            return redirect()->route('home');
        $alumno = Alumno::all()
            ->where('rut', $solicitud->rut)
            ->where("carrera",$solicitud->carrera)->first();
        if ($solicitud->resolucion_solicitud != $request->resolucion)
        {
            if(($solicitud->resolucion_solicitud == 'Autorizada' && $request->resolucion == 'Rechazada') || ($solicitud->resolucion_solicitud == 'Pendiente' && $request->resolucion == 'Rechazada'))
            {
                $usuario = User::find($alumno->id_user);
                $practica = Practica::all()->where('id_alumno', $alumno->id_alumno);
                $solicitud->id_alumno = null; //Para luego mostrar la solicitud Rechazada
                $solicitud->save();
                if($practica->count() > 1)
                {
                    $practica->last()->delete();
                }else
                    {
                        $usuario->delete();
                        $alumno->delete();
                    }
            }
            if($solicitud->resolucion_solicitud == 'Rechazada' && ($request->resolucion == 'Pendiente' || $request->resolucion == 'Autorizada'))
            {
                $fecha= date("Y-m-d H:i:s");
                $alumno = Alumno::all()
                    ->where('rut', $solicitud->rut)
                    ->where("carrera",$solicitud->carrera)->first();
                if($alumno == null)
                {
                    $nuevo = new Alumno;
                    $nuevo->nombre = $solicitud->nombre;
                    $nuevo->apellido_paterno = $solicitud->apellido_paterno;
                    $nuevo->apellido_materno = $solicitud->apellido_materno;
                    $nuevo->rut = $solicitud->rut;
                    $nuevo->email = $solicitud->email;
                    $nuevo->direccion = $solicitud->direccion;
                    $nuevo->fono = $solicitud->fono;
                    $nuevo->anno_ingreso = $solicitud->anno_ingreso;
                    $nuevo->carrera = $solicitud->carrera;
                    $nuevo->semestre_proyecto = $solicitud->semestre_proyecto;
                    $nuevo->anno_proyecto = $solicitud->anno_proyecto;
                    $nueva_instancia = new User;
                    $nueva_instancia->name = $nuevo->nombre;
                    $nueva_instancia->email = $nuevo->email;
                    $nueva_instancia->password = bcrypt($nuevo->rut);
                    $nueva_instancia->type = 'Alumno';
                    $nueva_instancia->save();
                    $nuevo->id_user = $nueva_instancia->id_user;
                    $nuevo->save();
                    $solicitud->id_alumno = $nuevo->id_alumno;
                    $solicitud->save();
                    $nueva_instancia = new Practica;
                    $nueva_instancia->f_solicitud = $fecha;
                    $nueva_instancia->id_alumno = $nuevo->id_alumno;
                    $nueva_instancia->save();
                }
                else {

                    $nueva_instancia = new Practica;
                    $nueva_instancia->f_solicitud = $fecha;
                    $nueva_instancia->id_alumno = $alumno->id_alumno;
                    $nueva_instancia->save();
                }
            }
        }
        $solicitud->resolucion_solicitud = $request->resolucion;
        $solicitud->observacion_solicitud = $request->observacion;
        $solicitud->save();

        $subject = "Estado solicitud de práctica";
        $for = $solicitud->email;
        $data = [
            'solicitud' => $solicitud,
            'request'=> $request
        ];
        Mail::send('Emails.notificacion',$data, function($msj) use($subject,$for){
            $msj->from("practicaprofesionalpucv@gmail.com","Docencia Escuela de Ingeniería Informática");
            $msj->subject($subject);
            $msj->to($for);
        });

        if($solicitud->carrera == "Ingeniería Civil Informática"){
            return redirect()->route('evaluacionSolicitud')->with('success','Registro creado satisfactoriamente');
        }
        else{
            return redirect()->route('evaluacionSolicitudEjecucion')->with('success','Registro creado satisfactoriamente');
        }
    }

    public function contact(Request $request){

        $url = url(route('formularioSolicitud'));
        $subject = "Formulario de solicitud práctica profesional";
        $for = $request->emailSolicitud;
        $data = [
            'url' => $url,
            'request'=> $request
        ];
        Mail::send('Emails.solicitud',$data, function($msj) use($subject,$for){
            $msj->from("practicaprofesionalpucv@gmail.com","Docencia Escuela de Ingeniería Informática");
            $msj->subject($subject);
            $msj->to($for);
        });
        return redirect()->route('descripcionSolicitud');
    }
}
