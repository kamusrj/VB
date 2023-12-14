<?php

namespace App\Http\Controllers;

use App\Models\TituloVenta;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PrincipalController extends Controller
{

    //inicio
    public function Home()
    {
        if (Auth::check()) {
            $userRole = Auth::user()->rol;

            switch ($userRole) {
                case 'a':
                case 'g':
                case 'c':
                    return view('perfil');

                case 'b':
                    return redirect('venta/bodega');
                default:
                    //redirecciona al encargado a su venta asignada

                    $titulo = TituloVenta::where('encargado', Auth::user()->correo)
                        ->where('estado', 'on')
                        ->first();
                    $tituloVenta = $titulo->id;
                    return redirect('panel/perfilVenta/' . $tituloVenta);
            }
        } else {
            return view('login');
        }
    }

    // recivelogin
    public function Iniciar(Request $request)
    {
        Validator::make(
            $request->all(),
            Usuario::ruleLogin()
        )->setAttributeNames(
            Usuario::attrLogin()
        )->validate();

        $user = Usuario::where("correo", $request->username)->first();

        if ($user)
            if (Hash::check($request->password, $user->clave))
                Auth::login($user);

        if (Auth::check())
            $request->session()->regenerate();
        else{
            Session::flash('type', 'danger');
            Session::flash('message', 'Usuario o Contraseña no valido');
        }

        return redirect()->back();
    }

    //cerrar sesion  
    public function Salir()
    {
        if (Auth::check())
            Auth::logout();
        return redirect("/");
    }
}
