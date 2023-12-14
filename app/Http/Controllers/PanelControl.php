<?php

namespace App\Http\Controllers;

use App\Models\EfectivoCambio;
use App\Models\Facturas;
use App\Models\Inventario;
use App\Models\TituloVenta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PanelControl extends Controller
{
    use HasFactory;

    public function stockVenta(Request $request)
    {
        $librosSeleccionados = $request->input('libros_seleccionados', []);
        $idVenta = $request->id;
        foreach ($librosSeleccionados as $key => $libro_id) {
            $inventario = Inventario::where('id_venta', $idVenta)
                ->where('id_libro', $libro_id)
                ->first();
            if ($inventario) {
                $inventario->stock_venta -= $request->input('venta')[$key];
                $inventario->save();
            } else {
                return 'Error: No se encontró el libro en el inventario para la venta especificada.';
            }
        }
        Session::flash('success', 'Inventario actualizado');
        return redirect()->back();
    }

    public function controlVenta($id)
    {
        $inventario = Inventario::join('libro as lb', 'inventario.id_libro', '=', 'lb.id')
            ->select(
                'inventario.*',
                'lb.nombre as nombre_libro'
            )
            ->where('id_venta', $id)->get();
        return view('dashboard.inventarioVenta')->with('inventario', $inventario);
    }

    public function ListarVentas()
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
            ->orderBy('fecha_creacion', 'asc')
            ->orderByRaw("titulo_venta.estado = 'on' desc")
            ->get();
        return view('dashboard.panel')->with('ventas', $ventas);
    }

    public function perfilVenta($id)
    {
        $tituloVenta = TituloVenta::join('institucion as ins', 'titulo_venta.institucion', '=', 'ins.codigo')
            ->select(
                'titulo_venta.*',
                'ins.nombre as institucion'
            )
            ->where('id', $id)->first();
        return view('dashboard.PerfilVenta')->with('tituloVenta', $tituloVenta);
    }

    public function inventarioVenta($id)
    {
        $inventario = Inventario::join('libro as lb', 'inventario.id_libro', '=', 'lb.id')
            ->select(
                'inventario.*',
                'lb.nombre as nombre_libro'
            )
            ->where('id_venta', $id)->get();
        return view('ventas.inventario')->with('inventario', $inventario);
    }
}
