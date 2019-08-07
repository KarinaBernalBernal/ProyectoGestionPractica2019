<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Empresa;

class EmpresaController extends Controller
{

    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Empresa::all();
        return view('Mantenedores/Empresas/lista_empresas',[
                'lista'=>$lista,
            ]);
    }
    public function crear()
    {
        return view('Mantenedores/Empresas/crear_empresa');
    }

    public function editar($id_elemento)
    {
        $elemento= Empresa::find($id_elemento);
        return view('Mantenedores/Empresas/editar_empresa',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearEmpresa (Request $request)
    {
        $data = $request->all();
        $nuevo = new Empresa;
        $nuevo->n_empresa = $data['n_empresa'];
        $nuevo->rut = $data['rut'];
        $nuevo->ciudad = $data['ciudad'];
        $nuevo->direccion = $data['direccion'];
        $nuevo->fono = $data['fono'];
        $nuevo->casilla = $data['casilla'];
        $nuevo->email = $data['email'];

        $nuevo->save();

        return redirect()->route('lista_empresas');
    }

    public function editarEmpresa(Request $request, $id_elemento)
    {
        $elemento_editar=Empresa::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->n_empresa=$request->n_empresa;
            $elemento_editar->rut=$request->rut;
            $elemento_editar->ciudad=$request->ciudad;
            $elemento_editar->direccion=$request->direccion;
            $elemento_editar->fono=$request->fono;
            $elemento_editar->casilla=$request->casilla;
            $elemento_editar->email=$request->email;

            $elemento_editar->save();

            return redirect()->route('lista_empresas');
        }
    }
    public function borrarEmpresa($id_elemento){
        $elemento_eliminar =  Empresa::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_empresas');
    }
}
