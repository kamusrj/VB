<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class Institucioncontroller extends Controller
{

    public function ListarInstitucion()
    {
        $instituciones = Institucion::all();
        return view('institucion')->with('instituciones', $instituciones);
    }

    function Obtener(Request $request)
    {

        $institucion = Institucion::where("codigo", $request->codigo)->first();
        return json_encode($institucion);
    }

    public function CrearInstitucion(Request $request)
    {
        Validator::make(
            $request->all(),
            Institucion::ruleCreate()
        )->addCustomAttributes(
            Institucion::attrCreate()
        )->validate();
        $school = new Institucion();
        $school->codigo = $request->codigo;
        $school->nombre = $request->nombre;
        $school->save();
        Session::flash('success', 'Institucion registrada correctamente');
        return redirect()->back();
    }
    public function actualizarInstitucion(Request $request)
    {
        Validator::make(
            $request->all(),
            Institucion::ruleUpdate()
        )->addCustomAttributes(
            Institucion::attrUpdate()
        )->validate();

        $school = Institucion::where('codigo', $request->codigo)->first();
        if ($school) {

            $school->nombre = $request->nombre;

            $school->save();
            Session::flash('success', 'Actulalizado correctamente');
            return redirect()->back();
        } else {

            return redirect()->back()->withErrors('Error al actualizar los datos');
        }
    }
    public function EliminarInstitucion(Request $request)
    {
        $school = $request->codigo;

        $school = Institucion::find($school);
        if ($school) {
            $school->delete();
            Session::flash('delete', 'Institucion eliminada');
        }
        return redirect()->back();
    }
}
