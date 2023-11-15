<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\Inventario;
use App\Models\TituloVenta;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class VentaController extends Controller
{



    public function inventario(Request $request)
    {
        $libros = $request->input('libros_seleccionados', []);

        foreach ($libros as $libro_id) {
            $in = new Inventario();
            $in->id_venta = $request->id_venta;
            $in->fecha = date('Y-m-d');
            $in->id_libro = $libro_id;
            $in->save();
        }
        return "correcto";
    }

    public function CrearVenta($id)
    {
        $school = Institucion::where('codigo', $id)->first();

        $vendedores = Usuario::where('rol', 'v')->get();
        $encargado = Usuario::where('rol', 'e')->get();

        return view('ventas.CrearVenta')
            ->with('school', $school)
            ->with('vendedores', $vendedores)
            ->with('encargado', $encargado);
    }
    public function CrearFacturas($id)
    {
        $tituloVenta = TituloVenta::where('id', $id)->first();

        return view('ventas/Facturas')->with('tituloVenta', $tituloVenta);
    }
    public function Crear(Request $request)
    {
        Validator::make(
            $request->all(),
            TituloVenta::ruleCreate()
        )->addCustomAttributes(
            TituloVenta::attrCreate()
        )->validate();
        $vd = new TituloVenta();
        $vd->institucion = $request->institucion;
        $vd->director = $request->director;
        $vd->encargado = $request->encargado;
        $vd->telefono = $request->telefono;
        $vd->vendedor = $request->vendedor;
        $vd->zona = $request->zona;
        $vd->direccion = $request->direccion;
        $vd->save();
        Institucion::where('codigo', $request->codigo)->update(['estado' => 'on']);
        $data = $vd->id;
        return redirect("venta/ventaf/$data");
    }
}
