<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LibrosController extends Controller
{

    public function Listar()
    {
        $user = Libro::paginate(10);
        return view('catalogo', compact('user'));
    }

    function Obtener(Request $request)
    {
        $libro  = Libro::where("id", $request->id)->first();
        return json_encode($libro);
    }

    public function CrearLibro(Request $request)
    {
        Validator::make(
            $request->all(),
            Libro::ruleCreate()
        )->addCustomAttributes(
            Libro::attrCreate()
        )->validate();

        $book = new Libro();
        $book->nombre = $request->nombre;
        $book->editorial = $request->editorial;
        $book->descripcion = $request->descripcion;
        $book->save();
        Session::flash('type', 'success');
        Session::flash('message', 'Libro creado correctamente');
        return redirect()->back();
    }

    public function actualizarLibro(Request $request)
    {
        Validator::make(
            $request->all(),
            Libro::ruleUpdate()
        )->addCustomAttributes(
            Libro::attrUpdate()
        )->validate();

        $book = Libro::where('id', $request->id)->first();

        if ($book) {
            $book->nombre = $request->nombre;

            $book->editorial = $request->editorial;
            $book->descripcion = $request->descripcion;

            $book->save();
            Session::flash('type', 'success');
            Session::flash('message', 'Actulalizado correctamente');
            return redirect()->back();
        }
        return redirect()->back()->withErrors('Error al actualizar los datos.');
    }

    public function EliminarLibro(Request $request)
    {
        $id = $request->id;
        $book = Libro::find($id);
        if ($book) {
            $book->delete();
            Session::flash('type', 'success');
            Session::flash('message', 'Libro eliminado correctamente');
            return redirect()->back();
        }
        return redirect()->back()->withErrors('Error: no se pudo realizar la acción.');
    }
}
