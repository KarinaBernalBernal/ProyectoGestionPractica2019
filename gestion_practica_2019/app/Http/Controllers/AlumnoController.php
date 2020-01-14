<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Alumno;
use SGPP\Autoevaluacion;
use SGPP\Empresa;
use SGPP\Solicitud;
use SGPP\Supervisor;
use SGPP\User;
use SGPP\Practica;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_administrador')->except('mostrarAutoEvaluacionModal', 'mostrarInscripcionModal');
    }

    //vista principal de un elemento en especifico
    public function lista(Request $request)
    {
        $lista= Alumno::filtrarYPaginar($request->get('buscador'),
                                        $request->get('nombre'),
                                        $request->get('apellido_paterno'),
                                        $request->get('apellido_materno'),
                                        $request->get('rut'),
                                        $request->get('email'),
                                        $request->get('anno_ingreso'),
                                        $request->get('carrera'));

        $contador = $lista->count();
        $lista = $lista->paginate(2);

        return view('Mantenedores/Alumnos/lista_alumnos')
            ->with("lista", $lista)
            ->with('contador',$contador);
    }

    public function crear()
    {
        return view('Mantenedores/Alumnos/crear_alumno');
    }

    public function editar($id_elemento)
    {
        $elemento= Alumno::find($id_elemento);
        return view('Mantenedores/Alumnos/editar_alumno',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearAlumno (Request $request)
    {
        $data = $request->all();
        $alumnoExistente = Alumno::where('rut', $request->rut)->first();
        if(!$alumnoExistente)
        {
            $nuevo = new Alumno;

            $nuevo->nombre = $data['nombre'];
            $nuevo->apellido_paterno = $data['apellido_paterno'];
            $nuevo->apellido_materno = $data['apellido_materno'];
            $nuevo->rut = $data['rut'];
            $nuevo->email = $data['email'];
            $nuevo->direccion = $data['direccion'];
            $nuevo->fono = $data['fono'];
            $nuevo->anno_ingreso = $data['anno_ingreso'];
            $nuevo->carrera = $data['carrera'];
            $nuevo->semestre_proyecto = $data['semestreProyecto'];
            $nuevo->anno_proyecto = $data['annoProyecto'];

            $nueva_instancia = new User;
            $nueva_instancia->name = $nuevo->nombre;
            $nueva_instancia->email = $nuevo->email;
            $nueva_instancia->password = bcrypt($data['rut']);
            $nueva_instancia->type = 'alumno';

            $nueva_instancia->save();

            $nuevo->id_user = $nueva_instancia->id_user;

            $nuevo->save();
        }

        return redirect()->route('lista_alumnos');
    }

    public function editarAlumno(Request $request, $id_elemento)
    {
        $elemento_editar=Alumno::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->nombre=$request->nombre;
			$elemento_editar->apellido_paterno=$request->apellido_paterno;
            $elemento_editar->apellido_materno=$request->apellido_materno;
            $elemento_editar->rut=$request->rut;
			$elemento_editar->email=$request->email;
            $elemento_editar->direccion=$request->direccion;
            $elemento_editar->fono=$request->fono;
			$elemento_editar->anno_ingreso=$request->anno_ingreso;
            $elemento_editar->carrera=$request->carrera;
            $elemento_editar->semestre_proyecto=$request->semestreProyecto;
            $elemento_editar->anno_proyecto=$request->annoProyecto;

            $user_editar=User::find($elemento_editar->id_user);
            if(isset($user_editar))
            {
                $user_editar->name=$request->nombre;
                $user_editar->email=$request->email;
                $user_editar->type=$user_editar->type;
            }
			$elemento_editar->id_user=$user_editar->id_user;
            $elemento_editar->save();

            $user_editar->save();

            return redirect()->route('lista_alumnos');
        }
    }

    public function borrarAlumno($id_elemento){
        $elemento_eliminar =  Alumno::find($id_elemento);
        $usuario_eliminar = User::find($elemento_eliminar->id_user);
        $usuario_eliminar->delete();
        return redirect()->route('lista_alumnos');
    }

    public function alumnosEnPractica(Request $request, $carrera)
    {
        //-----Alumnos de informatica-----//
        $alumnosInformatica = DB::table('alumnos')
            ->join('practicas', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
            //->join('solicitudes', 'solicitudes.id_alumno', 'alumnos.id_alumno')
            ->leftJoin('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->leftJoin('autoevaluaciones', 'autoevaluaciones.id_practica', 'practicas.id_practica')
            ->where('alumnos.carrera', '=', $carrera)
            ->where('practicas.f_inscripcion', '!=', null)
            ->where('resoluciones.resolucion_practica', '=', null)
            ->select('alumnos.*', 'autoevaluaciones.id_autoeval', 'practicas.f_inscripcion', 'resoluciones.resolucion_practica', 'practicas.id_practica')
            ->get();

        //-----Si no se seleccionaron filtros solo entregamos la consulta de la base-----//
        if ($request->nombre != null || $request->apellido_paterno != null || $request->rut != null || $request->email != null || $request->anno_ingreso != null )
        {
            //-----Filtro-----//
            $listaFiltrada= Alumno::filtrarAlumnosEnPractica(
                $request->get('nombre'),
                $request->get('apellido_paterno'),
                $request->get('rut'),
                $request->get('email'),
                $request->get('anno_ingreso'),
                $carrera
            );

            $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
            $listaFiltrada = $listaFiltrada->paginate(2);

            return view('Practicas/alumnos_en_practica')->with('lista',$listaFiltrada)
                ->with('contador',$contador)
                ->with('carrera', $carrera);
        }
        $contador = $alumnosInformatica->count(); //mostrara la cantidad de resultados en la tabla
        $alumnosInformatica = $alumnosInformatica->paginate(2);
        return view('Practicas/alumnos_en_practica')->with('lista',$alumnosInformatica)
            ->with('contador', $contador)
            ->with('carrera', $carrera);
    }

    public function mostrarSolicitudModal($id) //Mostrar el formulario del alumno
    {
        $solicitudes = Solicitud::where('id_alumno', $id)->first();

        return view('Practicas/modales/modalSolicitud')->with('solicitudes',$solicitudes);
    }

    public function mostrarInscripcionModal($id) //Mostrar el formulario del alumno
    {
        $practicas = Practica::where('id_practica', $id)->first();
        $alumnos = DB::table('alumnos')
            ->join('practicas', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
            ->where('practicas.id_practica', $id)
            ->select('alumnos.*')
            ->first();
        $supervisores = Supervisor::where('id_supervisor', $practicas->id_supervisor)->first();
        $empresas = Empresa::where('id_empresa', $supervisores->id_empresa)->first();

        return view('Practicas/modales/modalInscripcion')
            ->with('alumnos',$alumnos)
            ->with('practicas',$practicas)
            ->with('supervisores',$supervisores)
            ->with('empresas', $empresas);
    }

    public function mostrarAutoEvaluacionModal($id) //Mostrar el formulario del alumno
    {
        $autoEvaluacion = Autoevaluacion::where('id_autoeval', $id)->first();

        $desempennos = DB::table('autoevaluaciones')
            ->join('desempennos', 'desempennos.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
            ->where('autoevaluaciones.id_autoeval', $id)
            ->select('desempennos.*')
            ->get();
        $tareas = DB::table('autoevaluaciones')
            ->join('tareas', 'tareas.id_autoeval', 'autoevaluaciones.id_autoeval')
            ->where('autoevaluaciones.id_autoeval', $id)
            ->select('tareas.*')
            ->get();
        $habilidadesA = DB::table('autoevaluaciones')
            ->join('habilidades', 'habilidades.id_autoeval', 'autoevaluaciones.id_autoeval')
            ->where('autoevaluaciones.id_autoeval', $id)
            ->where('habilidades.tipo_habilidad', "faltante")
            ->select('habilidades.*')
            ->get();
        $habilidadesF = DB::table('autoevaluaciones')
            ->join('habilidades', 'habilidades.id_autoeval', 'autoevaluaciones.id_autoeval')
            ->where('autoevaluaciones.id_autoeval', $id)
            ->where('habilidades.tipo_habilidad', "aprendida")
            ->select('habilidades.*')
            ->get();
        $conocimientosA = DB::table('autoevaluaciones')
            ->join('conocimientos', 'conocimientos.id_autoeval', 'autoevaluaciones.id_autoeval')
            ->where('autoevaluaciones.id_autoeval', $id)
            ->where('conocimientos.tipo_conocimiento', "aprendida")
            ->select('conocimientos.*')
            ->get();
        $conocimientosF = DB::table('autoevaluaciones')
            ->join('conocimientos', 'conocimientos.id_autoeval', 'autoevaluaciones.id_autoeval')
            ->where('autoevaluaciones.id_autoeval', $id)
            ->where('conocimientos.tipo_conocimiento', "faltante")
            ->select('conocimientos.*')
            ->get();
        $conocimientosAd = DB::table('autoevaluaciones')
            ->join('conocimientos', 'conocimientos.id_autoeval', 'autoevaluaciones.id_autoeval')
            ->where('autoevaluaciones.id_autoeval', $id)
            ->where('conocimientos.tipo_conocimiento', "adquirida")
            ->select('conocimientos.*')
            ->get();
        $herramientasPractica = DB::table('herramientas_practica')
            ->join('herramientas', 'herramientas.id_herramienta', 'herramientas_practica.id_herramienta')
            ->where('herramientas_practica.id_autoeval', $id)
            ->select('herramientas.*')
            ->get();
        $areasautoeval = DB::table('areas_autoeval')
            ->join('areas', 'areas.id_area', 'areas_autoeval.id_area')
            ->where('areas_autoeval.id_autoeval', $id)
            ->select('areas.*')
            ->get();
        $evalActPracticas = DB::table('eval_act_practicas')
            ->join('eval_actitudinales', 'eval_actitudinales.id_actitudinal', 'eval_act_practicas.id_actitudinal')
            ->where('eval_act_practicas.id_autoeval', $id)
            ->select('eval_actitudinales.*', 'eval_act_practicas.valor_act_practica')
            ->get();
        $evalConPracticas = DB::table('eval_con_practicas')
            ->join('eval_conocimientos', 'eval_conocimientos.id_conocimiento', 'eval_con_practicas.id_conocimiento')
            ->where('eval_con_practicas.id_autoeval', $id)
            ->select('eval_conocimientos.*', 'eval_con_practicas.valor_con_practica')
            ->get();
        return view('Practicas/modales/modalAutoEvaluacion')
            ->with('desempennos',$desempennos)
            ->with('tareas',$tareas)
            ->with('habilidadesA',$habilidadesA)
            ->with('habilidadesF',$habilidadesF)
            ->with('conocimientosA',$conocimientosA)
            ->with('conocimientosF',$conocimientosF)
            ->with('conocimientosAd',$conocimientosAd)
            ->with('herramientasPractica',$herramientasPractica)
            ->with('areasautoeval',$areasautoeval)
            ->with('evalActPracticas',$evalActPracticas)
            ->with('evalConPracticas',$evalConPracticas)
            ->with('autoEvaluacion',$autoEvaluacion);

    }

}
