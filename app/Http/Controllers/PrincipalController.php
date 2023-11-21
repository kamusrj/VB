<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PrincipalController extends Controller
{

    public function Home()
    {

        if (Auth::check())
            if (in_array(Auth::user()->rol, ['a', 'g', 'c'])) {
                return view('perfil');
            } elseif (in_array(Auth::user()->rol, ['b'])) {
                return redirect('venta.Bodega');
            } else {

                return view('dashboard.panel');
            }
        return view("login");
    }


    public function Iniciar(Request $request)
    {
        //Validador
        Validator::make(
            $request->all(),
            Usuario::ruleLogin()
        )->setAttributeNames(
            Usuario::attrLogin()
        )->validate();

        $user = Usuario::where("correo", $request->username)->first();

        // Auntenticador
        /**
         * Clase Usuario, el middleware, Login 
         */
        if ($user)
            if (Hash::check($request->password, $user->clave))
                Auth::login($user);

        //Autorizador Clase Auth = Null = False
        if (Auth::check())
            $request->session()->regenerate();
        else
            return redirect()->back()->withErrors('Usuario o Contraseña no validos');


        return redirect()->back();
    }
    public function Salir()
    {
        if (Auth::check())
            Auth::logout();

        return redirect("/");
    }
}
