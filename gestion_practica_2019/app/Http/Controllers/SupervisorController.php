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

    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Supervisor::all();
        return view('Mantenedores/Supervisores/lista_supervisores',[
                'lista'=>$lista,
            ]);
    }

    //vista principal de un elemento en especifico
    public function listaSupervisores(Request $request)
    {
        $lista= Supervisor::filtrarYPaginar($request->get('buscador'),
            $request->get('nombre'),
            $request->get('apellido_paterno'),
            $request->get('email')
        );
        return view('Practicas.Ejecucion.supervisores_en_practica')->with("lista", $lista);
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
        //Verificar @Pablo y @Luis
        //$nuevo->apellido_materno = $data['apellido_materno'];
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
            //Verificar @Pablo y @Luis
            //$elemento_editar->apellido_materno=$request->apellido_materno;
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

    public function supervisoresEnPracticaEjecucion(Request $request)
    {
        //-----Supervisores de informatica-----//
        $supervisoresInformatica = DB::table('supervisores')
            ->join('practicas', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
            ->join('alumnos', 'alumnos.id_alumno', '=', 'practicas.id_alumno')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->where('alumnos.carrera', '=', "Ingeniería de Ejecución Informática")
            ->select('supervisores.*', 'evaluaciones_supervisor.*', 'alumnos.nombre as nombre_alumno', 'alumnos.apellido_paterno as apellido_alumno')
            ->get();

        $contador = $supervisoresInformatica->count(); //mostrara la cantidad de resultados en la tabla

        //-----Si no se seleccionaron filtros solo entregamos la consulta de la base-----//
        if ($request->nombre != null || $request->apellido_paterno != null || $request->email != null)
        {
            $supervisoresFiltrados = collect();

            //-----Filtro-----//
            $listaFiltrada= Supervisor::filtrarYPaginar($request->get('buscador'),
                $request->get('nombre'),
                $request->get('apellido_paterno'),
                $request->get('email')
            );

            if(count($listaFiltrada))
            {
                for($i = 0; $i<count($listaFiltrada,1); $i++)
                {
                    if($supervisoresInformatica->where('id_supervisor', $listaFiltrada[$i]->id_supervisor)->first())
                    {
                        $supervisoresFiltrados->push($supervisoresInformatica->where('id_supervisor', $listaFiltrada[$i]->id_supervisor)->first());
                    }
                }
            }
            $contador = $supervisoresFiltrados->count();  //mostrara la cantidad de resultados en la tabla filtrada
            $supervisoresFiltrados = $supervisoresFiltrados->paginate(5);
            return view('Practicas/Ejecucion/supervisores_en_practica')->with('lista',$supervisoresFiltrados)->with('contador', $contador);
        }
        $supervisoresInformatica = $supervisoresInformatica->paginate(5);
        return view('Practicas/Ejecucion/supervisores_en_practica')->with('lista',$supervisoresInformatica)->with('contador', $contador);
    }


    public function supervisoresEnPracticaCivil(Request $request)
    {
        //-----Supervisores de informatica-----//
        $supervisoresInformatica = DB::table('supervisores')
            ->join('practicas', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
            ->join('alumnos', 'alumnos.id_alumno', '=', 'practicas.id_alumno')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->where('alumnos.carrera', '=', "Ingeniería Civil Informática")
            ->select('supervisores.*', 'evaluaciones_supervisor.*', 'alumnos.nombre as nombre_alumno', 'alumnos.apellido_paterno as apellido_alumno')
            ->get();

        $contador = $supervisoresInformatica->count(); //mostrara la cantidad de resultados en la tabla

        //-----Si no se seleccionaron filtros solo entregamos la consulta de la base-----//
        if ($request->nombre != null || $request->apellido_paterno != null || $request->email != null)
        {
            $supervisoresFiltrados = collect();

            //-----Filtro-----//
            $listaFiltrada= Supervisor::filtrarYPaginar($request->get('buscador'),
                $request->get('nombre'),
                $request->get('apellido_paterno'),
                $request->get('email')
            );

            if(count($listaFiltrada))
            {
                for($i = 0; $i<count($listaFiltrada,1); $i++)
                {
                    if($supervisoresInformatica->where('id_supervisor', $listaFiltrada[$i]->id_supervisor)->first())
                    {
                        $supervisoresFiltrados->push($supervisoresInformatica->where('id_supervisor', $listaFiltrada[$i]->id_supervisor)->first());
                    }
                }
            }
            $contador = $supervisoresFiltrados->count();  //mostrara la cantidad de resultados en la tabla filtrada
            $supervisoresFiltrados = $supervisoresFiltrados->paginate(5);
            return view('Practicas/Civil/supervisores_en_practica')->with('lista',$supervisoresFiltrados)->with('contador', $contador);
        }
        $supervisoresInformatica = $supervisoresInformatica->paginate(5);
        return view('Practicas/Civil/supervisores_en_practica')->with('lista',$supervisoresInformatica)->with('contador', $contador);
    }

    public function mostrarEvaluacionModal($id)
    {
        $evaluacion = EvaluacionSupervisor::where('id_practica', $id)->first();

        return view('Practicas/modales/modalEvaluacion')->with('formulario',$evaluacion);
    }

}
