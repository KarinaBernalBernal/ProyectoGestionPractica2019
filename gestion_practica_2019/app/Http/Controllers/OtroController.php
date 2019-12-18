<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\OtrosHerramientas;
use SGPP\OtrosAreas;

class OtroController extends Controller
{
    public function lista()
    {
        $otrosHerramientas = OtrosHerramientas::all();
        $otrosAreas = OtrosAreas::all();

        return view('Mantenedores/Otros/lista_otros', [
            'otrosAreas' => $otrosAreas,
            'otrosHerramientas' => $otrosHerramientas,
        ]);
    }

    public function crear($tipo)
    {
        return view('Mantenedores/Otros/crear_otro_mantenedor')->with('tipo', $tipo);
    }

    public function crearElemento(Request $request, $tipo)
    {
        if ($tipo == "Área") {
            $nuevo = new OtrosAreas();
            $nuevo->n_area = $request->name;
            $nuevo->save();
        }
        if ($tipo == "Herramienta") {
            $nuevo = new OtrosHerramientas();
            $nuevo->n_herramienta = $request->name;
            $nuevo->save();
        }
        return redirect()->route('lista_otros');
    }

    public function editar($id_elemento, $tipo)
    {
        if ($tipo == "Área") {
            $elemento = OtrosAreas::find($id_elemento);
        }
        if ($tipo == "Herramienta") {
            $elemento = OtrosHerramientas::find($id_elemento);
        }

        return view('Mantenedores/Otros/editar_otro', [
            'elemento' => $elemento,
            'tipo' => $tipo,
        ]);
    }

    public function editarElemento(Request $request, $id_elemento, $tipo)
    {
        if ($tipo == "Área") {
            $elemento = OtrosAreas::find($id_elemento);
            if (isset($elemento)) {
                $elemento->n_area = $request->name;
                $elemento->save();
            }
        }
        if ($tipo == "Herramienta") {
            $elemento = OtrosHerramientas::find($id_elemento);
            if (isset($elemento)) {
                $elemento->n_herramienta = $request->name;
                $elemento->save();
            }
        }
        return redirect()->route('lista_otros');
    }

    public function borrarElemento($id_elemento, $tipo)
    {
        if ($tipo == "Área") {
            $elemento = OtrosAreas::find($id_elemento);
            $elemento->delete();
        }
        if ($tipo == "Herramienta") {
            $elemento = OtrosHerramientas::find($id_elemento);
            $elemento->delete();
        }
        return redirect()->route('lista_otros');
    }
}
