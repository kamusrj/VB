<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\Inventario;
use App\Models\Libro;
use App\Models\TituloVenta;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VentaController extends Controller
{
    public function inventario(Request $request)
    {
        $libros = $request->input('libros_seleccionados', []);

        foreach ($libros as $libro_id) {
            $in = new Inventario();
            $in->id_venta = $request->id_venta;
            $in->fecha = $request->fecha;
            $in->id_libro = $libro_id;
            $in->save();
        }
        $id = $request->id_venta;
        $fecha = $request->fecha;
        return redirect("panel/inventario/$id/$fecha");
    }

    public function ventaInventario(Request $request)
    {
        $librosSeleccionados = $request->input('libros_seleccionados', []);
        $idVenta = $request->id;


        foreach ($librosSeleccionados as $key => $libro_id) {
            $inventario = Inventario::where('id_venta', $idVenta)
                ->where('id_libro', $libro_id)
                ->where('fecha', $request->fecha)
                ->first();
            if ($inventario) {
                $inventario->stock = $request->input('stock')[$key];
                $inventario->stock_venta = $request->input('stock')[$key];
                $inventario->precio = $request->input('precio')[$key];
                $inventario->descuento = $request->input('descuento')[$key];
                $inventario->ofrecimiento_a = $request->input('ofrecimiento_a')[$key];

                $inventario->save();
            } else {
                return 'Error: No se encontró el libro en el inventario para la venta especificada.';
            }
        }

        return redirect('panel/programacion/' . $idVenta);
    }

    public function NuevaVenta(Request $request)
    {
        $escuela = Institucion::where('codigo', $request->id)->first();
        $vendedores = Usuario::where('rol', 'v')->get();
        $encargado = Usuario::where('rol', 'e')->get();
        return view('ventas.CrearVenta')
            ->with('escuela', $escuela)
            ->with('vendedores', $vendedores)
            ->with('encargado', $encargado);
    }

    public function CrearFacturas($id)
    {
        $tituloVenta = TituloVenta::where('id', $id)->first();
        $institucion = Institucion::where("codigo", $tituloVenta->institucion)->first();
        $conta = Usuario::where('rol', 'c')->get();
        return view('ventas/Facturas')
            ->with('tituloVenta', $tituloVenta)
            ->with('conta', $conta)
            ->with('institucion', $institucion);
    }

    public function Crear(Request $request)
    {
        Validator::make(
            $request->all(),
            TituloVenta::ruleCrear()
        )->addCustomAttributes(
            TituloVenta::attrCrear()
        )->validate();

        $usuario = Auth::user();

        $vd = TituloVenta::where('institucion', $request->codigo)
            ->first();
        if (!$vd) {

            $institucion = new Institucion();
            $institucion->codigo = $request->codigo;
            $institucion->nombre = $request->nombre;
            $institucion->save();

            $vd = new TituloVenta();
            $vd->institucion = $request->codigo;
        }

        $vd->director = $request->director;
        $vd->encargado = $request->encargado;
        $vd->telefono = $request->telefono;
        $vd->vendedor = $request->vendedor;
        $vd->zona = $request->zona;
        $vd->direccion = $request->direccion;
        $vd->autor = $usuario->correo;
        $vd->fecha_creacion = date('d-m-Y');
        $vd->save();

        Institucion::where('codigo', $request->codigo)->update(['estado' => 'on']);
        $data = $vd->id;

        // return redirect("venta/facturar/$data");
        Session::flash('success', 'Institucion registrada ');
        return redirect("panel");
    }

    function ListaLibros($id, $fecha)
    {


        $tituloVenta = TituloVenta::where('id', $id)->first();
        $libro = Libro::orderByRaw('FIELD(editorial, "ed", "mdf", "eng", "info")')->get();
        return view("ventas/Libros")
            ->with('libro', $libro)
            ->with('tituloVenta', $tituloVenta)
            ->with('fecha', $fecha);
    }

    // --------- Bodega-----------------
    public function bodegaBuscar(Request $request)
    {
        $data = Inventario::join('libro as lb', 'inventario.id_libro', '=', 'lb.id')
            ->join('titulo_venta as tv', 'inventario.id_venta', '=', 'tv.id')
            ->select(
                'inventario.*',
                'lb.nombre as nombre_libro',
            )
            ->where('id_venta', $request->id)->get();

        return json_encode($data);
    }

    public function perfilBodega()
    {
        $ventas = TituloVenta::join('usuario as enc', 'titulo_venta.encargado', '=', 'enc.correo')
            ->join('usuario as ven', 'titulo_venta.vendedor', '=', 'ven.correo')
            ->join('institucion as ins', 'titulo_venta.institucion', '=', 'ins.codigo')
            ->select(
                'titulo_venta.*',
                'enc.nombre as nombre_encargado',
                'enc.apellido as apellido_encargado',
                'ven.nombre as nombre_vendedor',
                'ven.apellido as apellido_vendedor',
                'ins.nombre as institucion_n'
            )
            ->where('titulo_venta.estado', 'off')
            ->get();
        return view('dashboard.bodega')->with('ventas', $ventas);
    }
}
