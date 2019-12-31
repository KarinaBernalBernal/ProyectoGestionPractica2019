<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Area;
use SGPP\Herramienta;
use SGPP\EvalConocimiento;
use SGPP\EvalActitudinal;

class ElementosDinamicosController extends Controller
{
    public function lista(Request $request, $elemento)
    {
        $area = Area::all();
        $herramienta = Herramienta::all();
        $evalConocimiento = EvalConocimiento::all();
        $evalActitudinal = EvalActitudinal::all();

        $contadorAreas = $area->count();
        $contadorHerramientas = $herramienta->count();
        $contadorConocimiento = $evalConocimiento->count();
        $contadorActitudinal = $evalActitudinal->count();

        $area = $area->paginateEspecial(10, null, null, "area");
        $herramienta = $herramienta->paginateEspecial(10, null, null, "herramienta");
        $evalConocimiento = $evalConocimiento->paginateEspecial(10, null, null, "conocimiento");
        $evalActitudinal = $evalActitudinal->paginateEspecial(10, null, null, "actitudinal");

        if( $elemento == "Área")
        {
            if ($request->nombre != null || $request->vigencia != null)
            {
                //-----Filtro-----//
                $listaFiltrada= Area::filtrarArea(
                    $request->get('nombre'),
                    $request->get('vigencia')
                );
                $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
                $listaFiltrada = $listaFiltrada->paginateEspecial(10, null, null, "area");

                return view('Mantenedores/Elementos Dinamicos/lista_elementos_dinamicos')
                    ->with('area',$listaFiltrada)
                    ->with('herramienta',$herramienta)
                    ->with('evalConocimiento',$evalConocimiento)
                    ->with('evalActitudinal',$evalActitudinal)
                    ->with('contadorAreas',$contador)
                    ->with('contadorHerramientas',$contadorHerramientas)
                    ->with('contadorConocimiento',$contadorConocimiento)
                    ->with('contadorActitudinal',$contadorActitudinal);
            }
        }

        if( $elemento == "Herramienta")
        {
            if ($request->nombre != null || $request->vigencia != null)
            {
                //-----Filtro-----//
                $listaFiltrada= Herramienta::filtrarHerramienta(
                    $request->get('nombre'),
                    $request->get('vigencia')
                );
                $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
                $listaFiltrada = $listaFiltrada->paginateEspecial(10, null, null, "herramienta");

                return view('Mantenedores/Elementos Dinamicos/lista_elementos_dinamicos')
                    ->with('area',$area)
                    ->with('herramienta',$listaFiltrada)
                    ->with('evalConocimiento',$evalConocimiento)
                    ->with('evalActitudinal',$evalActitudinal)
                    ->with('contadorAreas',$contadorAreas)
                    ->with('contadorHerramientas',$contador)
                    ->with('contadorConocimiento',$contadorConocimiento)
                    ->with('contadorActitudinal',$contadorActitudinal);
            }
        }

        if( $elemento == "Actitud" )
        {
            if ($request->nombre != null || $request->vigencia != null)
            {
                //-----Filtro-----//
                $listaFiltrada= EvalActitudinal::filtrarEvalActitudinal(
                    $request->get('nombre'),
                    $request->get('vigencia')
                );
                $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
                $listaFiltrada = $listaFiltrada->paginateEspecial(10, null, null, "actitudinal");

                return view('Mantenedores/Elementos Dinamicos/lista_elementos_dinamicos')
                    ->with('area',$area)
                    ->with('herramienta',$herramienta)
                    ->with('evalConocimiento',$evalConocimiento)
                    ->with('evalActitudinal',$listaFiltrada)
                    ->with('contadorAreas',$contadorAreas)
                    ->with('contadorHerramientas',$contadorHerramientas)
                    ->with('contadorConocimiento',$contadorConocimiento)
                    ->with('contadorActitudinal',$contador);
            }
        }

        if( $elemento == "Conocimiento" )
        {
            if ($request->nombre != null || $request->vigencia != null)
            {
                //-----Filtro-----//
                $listaFiltrada= EvalConocimiento::filtrarEvalConocimiento(
                    $request->get('nombre'),
                    $request->get('vigencia')
                );
                $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
                $listaFiltrada = $listaFiltrada->paginateEspecial(10, null, null, "conocimiento");

                return view('Mantenedores/Elementos Dinamicos/lista_elementos_dinamicos')
                    ->with('area',$area)
                    ->with('herramienta',$herramienta)
                    ->with('evalConocimiento',$listaFiltrada)
                    ->with('evalActitudinal',$evalActitudinal)
                    ->with('contadorAreas',$contadorAreas)
                    ->with('contadorHerramientas',$contadorHerramientas)
                    ->with('contadorConocimiento',$contador)
                    ->with('contadorActitudinal',$contadorActitudinal);
            }
        }

        return view('Mantenedores/Elementos Dinamicos/lista_elementos_dinamicos', [
            'area' => $area,
            'herramienta' => $herramienta,
            'evalConocimiento' => $evalConocimiento,
            'evalActitudinal' => $evalActitudinal,
            'contadorAreas'=> $contadorAreas,
            'contadorHerramientas' => $contadorHerramientas,
            'contadorConocimiento' => $contadorConocimiento,
            'contadorActitudinal' => $contadorActitudinal,
        ]);
    }

    public function crear($tipo)
    {
        return view('Mantenedores/Elementos Dinamicos/crear_elemento_dinamico_mantenedor')->with('tipo', $tipo);
    }

    public function crearElemento(Request $request, $tipo)
    {
        if ($tipo == "Área") {
            $nuevo = new Area();
            $nuevo->n_area = $request->name;
            $nuevo->save();
        }
        if ($tipo == "Herramienta") {
            $nuevo = new Herramienta();
            $nuevo->n_herramienta = $request->name;
            $nuevo->save();
        }
        if ($tipo == "Actitud") {
            $nuevo = new EvalActitudinal();
            $nuevo->n_act = $request->name;
            $nuevo->dp_act = $request->descripcion;
            $nuevo->save();
        }
        if ($tipo == "Conocimiento") {
            $nuevo = new EvalConocimiento();
            $nuevo->n_con = $request->name;
            $nuevo->dp_con = $request->descripcion;
            $nuevo->save();
        }
        return redirect()->route('lista_elementos_dinamicos',$tipo);
    }

    public function editar($id_elemento, $tipo)
    {
        if ($tipo == "Área") {
            $elemento = Area::find($id_elemento);
        }
        if ($tipo == "Herramienta") {
            $elemento = Herramienta::find($id_elemento);
        }
        if ($tipo == "Actitud") {
            $elemento = EvalActitudinal::find($id_elemento);
        }
        if ($tipo == "Conocimiento") {
            $elemento = EvalConocimiento::find($id_elemento);
        }
        return view('Mantenedores/Elementos Dinamicos/editar_elemento', [
            'elemento' => $elemento,
            'tipo' => $tipo,
        ]);
    }

    public function editarElemento(Request $request, $id_elemento, $tipo)
    {
        if ($tipo == "Área") {
            $elemento = Area::find($id_elemento);
            if (isset($elemento)) {
                $elemento->n_area = $request->name;
                $elemento->save();
            }
        }
        if ($tipo == "Herramienta") {
            $elemento = Herramienta::find($id_elemento);
            if (isset($elemento)) {
                $elemento->n_herramienta = $request->name;
                $elemento->save();
            }
        }
        if ($tipo == "Actitud") {
            $elemento = EvalActitudinal::find($id_elemento);
            if (isset($elemento)) {
                $elemento->n_act = $request->name;
                $elemento->dp_act = $request->descripcion;
                $elemento->save();
            }
        }
        if ($tipo == "Conocimiento") {
            $elemento = EvalConocimiento::find($id_elemento);
            if (isset($elemento)) {
                $elemento->n_con = $request->name;
                $elemento->dp_con = $request->descripcion;
                $elemento->save();
            }
        }
        return redirect()->route('lista_elementos_dinamicos',$tipo);
    }

    public function borrarElemento($id_elemento, $tipo)
    {
        if ($tipo == "Área") {
            $elemento = Area::find($id_elemento);
            $elemento->delete();
        }
        if ($tipo == "Herramienta") {
            $elemento = Herramienta::find($id_elemento);
            $elemento->delete();
        }
        if ($tipo == "Actitud") {
            $elemento = EvalActitudinal::find($id_elemento);
            $elemento->delete();
        }
        if ($tipo == "Conocimiento") {
            $elemento = EvalConocimiento::find($id_elemento);
            $elemento->delete();
        }
        return redirect()->route('lista_elementos_dinamicos',$tipo);
    }

    public function modificarVigencia(Request $request)
    {
        if($request->tipo == "area")
        {
            $elemento = Area::all()->where('id_area', $request->id)->first();
        }
        if($request->tipo == "herramienta")
        {
            $elemento = Herramienta::all()->where('id_herramienta', $request->id)->first();
        }
        if($request->tipo == "actitud")
        {
            $elemento = EvalActitudinal::all()->where('id_actitudinal', $request->id)->first();
        }
        if($request->tipo == "conocimiento")
        {
            $elemento = EvalConocimiento::all()->where('id_conocimiento', $request->id)->first();
        }

        if($elemento->vigencia != 1)
        {
            $elemento->vigencia = 1;
        }else
        {
            $elemento->vigencia = 2;
        }
        $elemento->save();
    }
}
