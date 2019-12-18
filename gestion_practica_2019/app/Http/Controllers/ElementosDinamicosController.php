<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Area;
use SGPP\Herramienta;
use SGPP\EvalConocimiento;
use SGPP\EvalActitudinal;

class ElementosDinamicosController extends Controller
{
    public function lista()
    {
        $area = Area::all();
        $herramienta = Herramienta::all();
        $evalConocimiento = EvalConocimiento::all();
        $evalActitudinal = EvalActitudinal::all();

        return view('Mantenedores/Elementos Dinamicos/lista_elementos_dinamicos',[
            'area'=>$area,
            'herramienta'=>$herramienta,
            'evalConocimiento'=>$evalConocimiento,
            'evalActitudinal'=>$evalActitudinal,
        ]);
    }

    public function crear($tipo)
    {
        return view('Mantenedores/Elementos Dinamicos/crear_elemento_dinamico_mantenedor')->with('tipo',$tipo);
    }

    public function crearElemento (Request $request, $tipo)
    {
        if($tipo == "Área")
        {
            $nuevo = new Area();
            $nuevo->n_area = $request->name;
            $nuevo->save();
        }
        if($tipo == "Herramienta")
        {
            $nuevo = new Herramienta();
            $nuevo->n_herramienta = $request->name;
            $nuevo->save();
        }
        if($tipo == "Actitud")
        {
            $nuevo = new EvalActitudinal();
            $nuevo->n_act = $request->name;
            $nuevo->dp_act = $request->descripcion;
            $nuevo->save();
        }
        if($tipo == "Conocimiento")
        {
            $nuevo = new EvalConocimiento();
            $nuevo->n_con = $request->name;
            $nuevo->dp_con = $request->descripcion;
            $nuevo->save();
        }
        return redirect()->route('lista_elementos_dinamicos');
    }

    public function editar($id_elemento, $tipo)
    {
        if($tipo == "Área")
        {
            $elemento= Area::find($id_elemento);
        }
        if($tipo == "Herramienta")
        {
            $elemento= Herramienta::find($id_elemento);
        }
        if($tipo == "Actitud")
        {
            $elemento= EvalActitudinal::find($id_elemento);
        }
        if($tipo == "Conocimiento")
        {
            $elemento= EvalConocimiento::find($id_elemento);
        }
        return view('Mantenedores/Elementos Dinamicos/editar_elemento',[
            'elemento'=>$elemento,
            'tipo'=>$tipo,
        ]);
    }

    public function editarElemento(Request $request, $id_elemento, $tipo)
    {
        if($tipo == "Área")
        {
            $elemento= Area::find($id_elemento);
            if(isset($elemento))
            {
                $elemento->n_area = $request->name;
                $elemento->save();
            }
        }
        if($tipo == "Herramienta")
        {
            $elemento= Herramienta::find($id_elemento);
            if(isset($elemento))
            {
                $elemento->n_herramienta = $request->name;
                $elemento->save();
            }
        }
        if($tipo == "Actitud")
        {
            $elemento= EvalActitudinal::find($id_elemento);
            if(isset($elemento))
            {
                $elemento->n_act = $request->name;
                $elemento->dp_act = $request->descripcion;
                $elemento->save();
            }
        }
        if($tipo == "Conocimiento")
        {
            $elemento= EvalConocimiento::find($id_elemento);
            if(isset($elemento))
            {
                $elemento->n_con = $request->name;
                $elemento->dp_con = $request->descripcion;
                $elemento->save();
            }
        }
        return redirect()->route('lista_elementos_dinamicos');
    }

    public function borrarElemento($id_elemento, $tipo)
    {
        if($tipo == "Área")
        {
            $elemento= Area::find($id_elemento);
            $elemento->delete();
        }
        if($tipo == "Herramienta")
        {
            $elemento= Herramienta::find($id_elemento);
            $elemento->delete();
        }
        if($tipo == "Actitud")
        {
            $elemento= EvalActitudinal::find($id_elemento);
            $elemento->delete();
        }
        if($tipo == "Conocimiento")
        {
            $elemento= EvalConocimiento::find($id_elemento);
            $elemento->delete();
        }
        return redirect()->route('lista_elementos_dinamicos');
    }
}
