<?php

namespace SGPP\Http\Controllers;

use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use SGPP\Administrador;
use SGPP\EvalActEmpPractica;
use SGPP\EvalConEmpPractica;
use SGPP\Practica;
use SGPP\EvalActitudinal;
use SGPP\EvalConocimiento;
use SGPP\Resolucion;
use SGPP\Alumno;
use SGPP\EvaluacionSupervisor;
use Illuminate\Support\Facades\DB;
use SGPP\User;
use Mail;

class ResolucionPracticaController extends Controller
{
    public function resolucionCivil()
    {
        $practicasP = DB::table('practicas')
            ->join('alumnos', 'alumnos.id_alumno', 'practicas.id_alumno')
            ->leftJoin('supervisores', 'supervisores.id_supervisor', 'practicas.id_supervisor')
            ->leftJoin('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->where('alumnos.carrera', "Ingeniería Civil Informática")
            ->where('resoluciones.id_resolucion', NULL)
            ->select('practicas.*', 'alumnos.rut', 'alumnos.nombre AS nombreAlumno', 'alumnos.apellido_paterno AS apellidoAlumno', 'supervisores.nombre', 'supervisores.apellido_paterno', 'supervisores.email AS emailSupervisor')
            ->get();

        $practicasE = DB::table('practicas')
            ->join('alumnos', 'alumnos.id_alumno', 'practicas.id_alumno')
            ->leftJoin('supervisores', 'supervisores.id_supervisor', 'practicas.id_supervisor')
            ->Join('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->where('alumnos.carrera', "Ingeniería Civil Informática")
            ->select('practicas.*', 'alumnos.rut', 'alumnos.nombre AS nombreAlumno', 'alumnos.apellido_paterno AS apellidoAlumno', 'supervisores.nombre', 'supervisores.apellido_paterno', 'resoluciones.resolucion_practica', 'resoluciones.f_resolucion', 'supervisores.email AS emailSupervisor')
            ->get();

        return view('4 Resoluciones/resolucionPractica',[
            'practicasP'=>$practicasP,
            'practicasE'=>$practicasE
        ]);
    }
    /* ----------- Lista de Practicas Ejecucion  ----------  */
    public function resolucionEjecucion()
    {
        $practicasP = DB::table('practicas')
            ->join('alumnos', 'alumnos.id_alumno', 'practicas.id_alumno')
            ->leftJoin('supervisores', 'supervisores.id_supervisor', 'practicas.id_supervisor')
            ->leftJoin('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->where('alumnos.carrera', "Ingeniería de Ejecución Informática")
            ->where('resoluciones.id_resolucion', NULL)
            ->select('practicas.*', 'alumnos.rut', 'alumnos.nombre AS nombreAlumno', 'alumnos.apellido_paterno AS apellidoAlumno', 'supervisores.nombre', 'supervisores.apellido_paterno', 'supervisores.email AS emailSupervisor')
            ->get();

        $practicasE = DB::table('practicas')
            ->join('alumnos', 'alumnos.id_alumno', 'practicas.id_alumno')
            ->leftJoin('supervisores', 'supervisores.id_supervisor', 'practicas.id_supervisor')
            ->Join('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->where('alumnos.carrera', "Ingeniería de Ejecución Informática")
            ->select('practicas.*', 'alumnos.rut', 'alumnos.nombre AS nombreAlumno', 'alumnos.apellido_paterno AS apellidoAlumno', 'supervisores.nombre', 'supervisores.apellido_paterno', 'resoluciones.resolucion_practica', 'resoluciones.f_resolucion', 'supervisores.email AS emailSupervisor')
            ->get();

        return view('4 Resoluciones/resolucionPractica',[
            'practicasP'=>$practicasP,
            'practicasE'=>$practicasE
        ]);
    }

    public function resolucionPracticaModal($id)
    {
        $practicas = DB::table('practicas')
            ->join('alumnos', 'alumnos.id_alumno', 'practicas.id_alumno')
            ->leftJoin('supervisores', 'supervisores.id_supervisor', 'practicas.id_supervisor')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->where('practicas.id_practica', $id)
            ->select('practicas.*', 'alumnos.rut', 'alumnos.nombre AS nombreAlumno', 'alumnos.apellido_paterno AS apellidoAlumno'
                , 'alumnos.carrera', 'alumnos.email AS emailAlumno', 'supervisores.nombre', 'supervisores.apellido_paterno','evaluaciones_supervisor.resultado_eval'
                ,'evaluaciones_supervisor.id_eval_supervisor AS idEvaluacionSupervisor')
            ->get();

        $respuestasActitudes = DB::table('practicas')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->leftJoin('eval_act_emp_practica', 'eval_act_emp_practica.id_eval_supervisor', 'evaluaciones_supervisor.id_eval_supervisor')
            ->where('practicas.id_practica', $id)
            ->where('valor_act_emp_practica','!=','NA')
            ->select('eval_act_emp_practica.valor_act_emp_practica')
            ->get();

        $respuestasConocimientos = DB::table('practicas')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->leftJoin('eval_con_emp_practicas', 'eval_con_emp_practicas.id_eval_supervisor', 'evaluaciones_supervisor.id_eval_supervisor')
            ->where('practicas.id_practica', $id)
            ->where('valor_con_emp_practica','!=','NA')
            ->select('eval_con_emp_practicas.valor_con_emp_practica')
            ->get();

        $evaluador = auth()->user();

        $maximoAplicableA = count($respuestasActitudes)*4;
        $maximoAplicableC = count($respuestasConocimientos)*4;
        $puntajeObtenidoA = 0;
        $puntajeObtenidoC = 0;

        for($i = 0; $i<count($respuestasActitudes,1); $i++)
        {
            if($respuestasActitudes[$i]->valor_act_emp_practica != "NL")
            {
                $puntajeObtenidoA += $respuestasActitudes[$i]->valor_act_emp_practica;
            }
        }

        for($i = 0; $i<count($respuestasConocimientos,1); $i++)
        {
            if($respuestasConocimientos[$i]->valor_con_emp_practica != "NL")
            {
                $puntajeObtenidoC += $respuestasConocimientos[$i]->valor_con_emp_practica;
            }
        }

        if($maximoAplicableA != 0)
        {
            $porcentajeA = $puntajeObtenidoA / $maximoAplicableA * 100;
        }else
        {
            $porcentajeA = 0;
        }
        if ($maximoAplicableC != 0)
        {
            $porcentajeC = $puntajeObtenidoC / $maximoAplicableC * 100;
        }else
        {
            $porcentajeC = 0;
        }

        return view('4 Resoluciones/modales/modalResolucionPractica',[
            'practicas'=>$practicas,
            'maximoAplicableA'=>$maximoAplicableA,
            'maximoAplicableC'=>$maximoAplicableC,
            'puntajeObtenidoA'=>$puntajeObtenidoA,
            'puntajeObtenidoC'=>$puntajeObtenidoC,
            'porcentajeA'=> $porcentajeA,
            'porcentajeC'=> $porcentajeC,
            'evaluador' => $evaluador,
        ]);
    }

    public function modificarResolucionPracticaModal($id){
        $practicas = DB::table('practicas')
            ->join('alumnos', 'alumnos.id_alumno', 'practicas.id_alumno')
            ->leftJoin('supervisores', 'supervisores.id_supervisor', 'practicas.id_supervisor')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->join('resoluciones', 'resoluciones.id_practica','practicas.id_practica')
            ->join('administradores', 'administradores.id_admin','resoluciones.id_admin')
            ->where('practicas.id_practica', $id)
            ->select('practicas.*', 'alumnos.rut', 'alumnos.nombre AS nombreAlumno', 'alumnos.apellido_paterno AS apellidoAlumno'
                ,'alumnos.carrera', 'supervisores.nombre', 'supervisores.apellido_paterno','evaluaciones_supervisor.resultado_eval'
                ,'evaluaciones_supervisor.id_eval_supervisor AS idEvaluacionSupervisor', 'resoluciones.resolucion_practica'
                , 'resoluciones.observacion_resolucion', 'administradores.nombre AS nombreAdmin', 'administradores.apellido_paterno AS apellidoPAdmin'
                , 'administradores.apellido_materno AS apellidoMAdmin')
            ->get();

        $respuestasActitudes = DB::table('practicas')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->leftJoin('eval_act_emp_practica', 'eval_act_emp_practica.id_eval_supervisor', 'evaluaciones_supervisor.id_eval_supervisor')
            ->where('practicas.id_practica', $id)
            ->where('valor_act_emp_practica','!=','NA')
            ->select('eval_act_emp_practica.valor_act_emp_practica')
            ->get();

        $respuestasConocimientos = DB::table('practicas')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->leftJoin('eval_con_emp_practicas', 'eval_con_emp_practicas.id_eval_supervisor', 'evaluaciones_supervisor.id_eval_supervisor')
            ->where('practicas.id_practica', $id)
            ->where('valor_con_emp_practica','!=','NA')
            ->select('eval_con_emp_practicas.valor_con_emp_practica')
            ->get();

        $nuevoEvaluador = auth()->user();

        $maximoAplicableA = count($respuestasActitudes)*4;
        $maximoAplicableC = count($respuestasConocimientos)*4;
        $puntajeObtenidoA = 0;
        $puntajeObtenidoC = 0;

        for($i = 0; $i<count($respuestasActitudes,1); $i++)
        {
            if($respuestasActitudes[$i]->valor_act_emp_practica != "NL")
            {
                $puntajeObtenidoA += $respuestasActitudes[$i]->valor_act_emp_practica;
            }
        }

        for($i = 0; $i<count($respuestasConocimientos,1); $i++)
        {
            if($respuestasConocimientos[$i]->valor_con_emp_practica != "NL")
            {
                $puntajeObtenidoC += $respuestasConocimientos[$i]->valor_con_emp_practica;
            }
        }

        if($maximoAplicableA != 0)
        {
            $porcentajeA = $puntajeObtenidoA / $maximoAplicableA * 100;
        }else
        {
            $porcentajeA = 0;
        }
        if ($maximoAplicableC != 0)
        {
            $porcentajeC = $puntajeObtenidoC / $maximoAplicableC * 100;
        }else
        {
            $porcentajeC = 0;
        }

        return view('4 Resoluciones/modales/modalModificarResolucionPractica',[
            'practicas'=>$practicas,
            'maximoAplicableA'=>$maximoAplicableA,
            'maximoAplicableC'=>$maximoAplicableC,
            'puntajeObtenidoA'=>$puntajeObtenidoA,
            'puntajeObtenidoC'=>$puntajeObtenidoC,
            'porcentajeA'=> $porcentajeA,
            'porcentajeC'=> $porcentajeC,
            'nuevoEvaluador' => $nuevoEvaluador,
        ]);
    }
    /* Funciones modales */
    public function evaluarPractica(Request $request, $id, $email, $name)
    {
        $practica = Practica::find($id);
        $alumno = Alumno::where('id_alumno', $practica->id_alumno)->first();
        $evaluador = Administrador::where('email', $email)->where('nombre', $name)->first();
        $fecha= date("Y-m-d");

        $resolucion = new Resolucion();

        $resolucion->observacion_resolucion = $request->observacion;
        $resolucion->f_resolucion = $fecha;
        $resolucion->resolucion_practica = $request->resolucion;
        $resolucion->id_practica = $practica->id_practica;
        $resolucion->id_admin = $evaluador->id_admin;
        $resolucion->save();

        $subject = "Estado resolución de práctica";
        $for = $alumno->email;
        $data = [
            'alumno' => $alumno,
            'request'=> $request
        ];
        /*
        Mail::send('Emails.resolucion',$data, function($msj) use($subject,$for){
            $msj->from("practicaprofesionalpucv@gmail.com","Docencia Escuela de Ingeniería Informática");
            $msj->subject($subject);
            $msj->to($for);
        });
        */
        return redirect()->route('ResolucionPracticaEjecucion')->with('success','Registro creado satisfactoriamente');
    }
    public function modificarResolucionPractica(Request $request, $id, $email, $nombre)
    {
        $practica = Practica::find($id);
        $alumno = Alumno::where('id_alumno', $practica->id_alumno)->first();
        $nuevoEvaluador = Administrador::where('email', $email)->where('nombre', $nombre)->first();
        $fecha = date("Y-m-d");
        $resolucion = Resolucion::where('id_practica', $practica->id_practica)->first();

        $resolucion->observacion_resolucion = $request->observacion;
        $resolucion->f_resolucion = $fecha;
        $resolucion->resolucion_practica = $request->resolucion;
        $resolucion->id_admin = $nuevoEvaluador->id_admin;

        $resolucion->save();
        $data = [
            'alumno' => $alumno,
            'request'=> $request
        ];
        /*
        $subject = "Modificación de resolución de práctica";
        $for = $alumno->email;

        Mail::send('Emails.resolucion',$data, function($msj) use($subject,$for){
            $msj->from("practicaprofesionalpucv@gmail.com","Docencia Escuela de Ingeniería Informática");
            $msj->subject($subject);
            $msj->to($for);
        });
        */
        return redirect()->route('ResolucionPracticaEjecucion')->with('success', 'Registro creado satisfactoriamente');
    }
}
