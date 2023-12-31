<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller

{

    function Obtener(Request $request)
    {
        $usuario = Usuario::where("correo", $request->correo)->first();
        return json_encode($usuario);
    }

    public function Listar()
    {
        $listar = Usuario::where('rol', '<>', 'a')->paginate(6);
        return view('usuario', compact('listar'));
    }

    public function CrearUsuario(Request $request)
    {
        Validator::make(
            $request->all(),
            Usuario::ruleCreate()
        )->addCustomAttributes(
            Usuario::attrCreate()
        )->validate();

        $usuario = new Usuario();

        $usuario->correo = $request->correo;
        $usuario->clave = Hash::make($request->clave);
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->rol = $request->rol;
        $usuario->save();

        Session::flash('type', 'success');
        Session::flash('message', 'Usuario creado correctamente');

        return redirect()->back();
    }

    public function actualizarUsuario(Request $request)
    {
        Validator::make(
            $request->all(),
            Usuario::ruleUpdate()
        )->addCustomAttributes(
            Usuario::attrUpdate()
        )->validate();

        $usuario = Usuario::where('correo', $request->correo)->first();
        if ($usuario) {

            if ($request->clave != null)
                $usuario->clave = Hash::make($request->clave);
            $usuario->nombre = $request->nombre;
            $usuario->apellido = $request->apellido;

            $usuario->save();
            Session::flash('type', 'success');
            Session::flash('message', 'Actulalizado correctamente');
            return redirect()->back();
        } else {

            return redirect()->back()->withErrors('Error al actualizar los datos');
        }
    }

    public function EliminarUsuario(Request $request)
    {
        $id = $request->id;

        $book = Usuario::find($id);
        if ($book) {
            $book->delete();
            Session::flash('delete', 'Usuario eliminado');
        } else {

            Session::flash('delete', 'error');
        }
        return redirect()->back();
    }
}
