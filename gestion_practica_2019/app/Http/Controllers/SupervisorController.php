<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\EvaluacionSupervisor;
use SGPP\Supervisor;
use SGPP\User;
use SGPP\Empresa;
use SGPP\Alumno;
use SGPP\Practica;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_administrador')->except('mostrarEvaluacionModal');
    }

    //vista principal de un elemento en especifico
    public function lista( Request $request)
    {
        $lista= Supervisor::all();
        $contador = $lista->count();

        if ($request->nombre != null || $request->apellido_paterno != null || $request->email != null || $request->fono != null )
        {
            //-----Filtro-----//
            $listaFiltrada= Supervisor::filtrarSupervisores(
                $request->get('nombre'),
                $request->get('apellido_paterno'),
                $request->get('email'),
                $request->get('fono')
            );
            $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
            $listaFiltrada = $listaFiltrada->paginate(2);

            return view('Mantenedores/Supervisores/lista_supervisores')->with('lista',$listaFiltrada)->with('contador',$contador);
        }

        $lista = $lista->paginate(2);
        return view('Mantenedores/Supervisores/lista_supervisores',[
                'lista'=>$lista,
                'contador'=>$contador,
            ]);
    }

    public function crear()
    {
        $empresas= Empresa::all();

        return view('Mantenedores/Supervisores/crear_supervisor')->with('empresas', $empresas);
    }

    public function editar($id_elemento)
    {
        $elemento= Supervisor::find($id_elemento);
        $empresas= Empresa::all();

        return view('Mantenedores/Supervisores/editar_supervisor',[
                'elemento'=>$elemento,
                'empresas' => $empresas,
            ]);
    }

    public function crearSupervisor (Request $request)
    {
        $data = $request->all();
        $nuevo = new Supervisor;
        $nuevo->nombre = $data['nombre'];
        $nuevo->apellido_paterno = $data['apellido_paterno'];
        $nuevo->cargo = $data['cargo'];
        $nuevo->departamento = $data['departamento'];
        $nuevo->email = $data['email'];
        $nuevo->fono = $data['fono'];
        $empresa = $data['id_empresa'];

        $nuevo->id_empresa = $empresa;

        $nueva_instancia = new User;
        $nueva_instancia->name = $nuevo->nombre;
        $nueva_instancia->email = $nuevo->email;
        $nueva_instancia->password = bcrypt($data['nombre']);
        $nueva_instancia->type = 'supervisor';
        $nueva_instancia->save();

        $nuevo->id_user = $nueva_instancia->id_user;

        $nuevo->save();

        return redirect()->route('lista_supervisores');
    }

    public function editarSupervisor(Request $request, $id_elemento)
    {
        $elemento_editar=Supervisor::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->nombre=$request->nombre;
            $elemento_editar->apellido_paterno=$request->apellido_paterno;
            $elemento_editar->cargo=$request->cargo;
            $elemento_editar->departamento=$request->departamento;
            $elemento_editar->email=$request->email;
            $elemento_editar->fono=$request->fono;
            $elemento_editar->id_empresa=$request->id_empresa;

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
            return redirect()->route('lista_supervisores');
        }
    }

    public function borrarSupervisor($id_elemento){
        $elemento_eliminar =  Empresa::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_supervisores');
    }

    public function supervisoresEnPractica(Request $request, $carrera)
    {
        //-----Supervisores de informatica-----//
        $supervisoresInformatica = DB::table('supervisores')
            ->join('practicas', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
            ->join('alumnos', 'alumnos.id_alumno', '=', 'practicas.id_alumno')
            ->leftJoin('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->where('alumnos.carrera', '=', $carrera)
            ->where('resoluciones.resolucion_practica', '=', null)
            ->select('supervisores.*', 'evaluaciones_supervisor.*', 'alumnos.nombre as nombre_alumno', 'alumnos.apellido_paterno as apellido_alumno')
            ->get();

        //-----Si no se seleccionaron filtros solo entregamos la consulta de la base-----//
        if ($request->nombre != null || $request->apellido_paterno != null || $request->email != null || $request->fono != null)
        {
            //-----Filtro-----//
            $listaFiltrada= Supervisor::filtrarSupervisoresEnPractica(
                $request->get('nombre'),
                $request->get('apellido_paterno'),
                $request->get('email'),
                $request->get('fono'),
                $carrera
            );
            $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
            $listaFiltrada = $listaFiltrada->paginate(2);
            return view('Practicas/supervisores_en_practica')->with('lista',$listaFiltrada)
                ->with('contador', $contador)
                ->with('carrera', $carrera);
        }
        $contador = $supervisoresInformatica->count(); //mostrara la cantidad de resultados en la tabla
        $supervisoresInformatica = $supervisoresInformatica->paginate(2);
        return view('Practicas/supervisores_en_practica')->with('lista',$supervisoresInformatica)
            ->with('contador', $contador)
            ->with('carrera', $carrera);
    }

    public function mostrarEvaluacionModal($id)
    {
        $evaluacion = EvaluacionSupervisor::where('id_eval_supervisor', $id)->first();

        $fortalezas = DB::table('evaluaciones_supervisor')
            ->join('fortalezas', 'fortalezas.id_eval_supervisor', 'evaluaciones_supervisor.id_eval_supervisor')
            ->where('evaluaciones_supervisor.id_eval_supervisor', $id)
            ->select('fortalezas.*')
            ->get();
        $debilidades = DB::table('evaluaciones_supervisor')
            ->join('debilidades', 'debilidades.id_eval_supervisor', 'evaluaciones_supervisor.id_eval_supervisor')
            ->where('evaluaciones_supervisor.id_eval_supervisor', $id)
            ->select('debilidades.*')
            ->get();
        $areasevaluacion = DB::table('area_evaluacion')
            ->join('areas', 'areas.id_area', 'area_evaluacion.id_area')
            ->where('area_evaluacion.id_eval_supervisor', $id)
            ->select('areas.*')
            ->get();
        $evalActEmpresas = DB::table('eval_act_emp_practica')
            ->join('eval_actitudinales', 'eval_actitudinales.id_actitudinal', 'eval_act_emp_practica.id_actitudinal')
            ->where('eval_act_emp_practica.id_eval_supervisor', $id)
            ->select('eval_actitudinales.*', 'eval_act_emp_practica.valor_act_emp_practica')
            ->get();
        $evalConEmpresas = DB::table('eval_con_emp_practicas')
            ->join('eval_conocimientos', 'eval_conocimientos.id_conocimiento', 'eval_con_emp_practicas.id_conocimiento')
            ->where('eval_con_emp_practicas.id_eval_supervisor', $id)
            ->select('eval_conocimientos.*', 'eval_con_emp_practicas.valor_con_emp_practica')
            ->get();

        return view('Practicas/modales/modalEvaluacion')
            ->with('fortalezas',$fortalezas)
            ->with('debilidades',$debilidades)
            ->with('areasevaluacion',$areasevaluacion)
            ->with('evalActEmpresas',$evalActEmpresas)
            ->with('evalConEmpresas',$evalConEmpresas)
            ->with('evaluacion',$evaluacion);
    }

}
