<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function listar()
    {
        $listar = Usuario::where('rol', '<>', 'a')->paginate(6);
        return view('usuario', compact('listar'));
    }

    function Obtener(Request $request)
    {
        return json_encode(DB::select("select * from usuario where correo = ?", [$request->correo]));
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
        Session::flash('success', 'Usuario creado correctamente');

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
            Session::flash('success', 'Actulalizado correctamente');
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
