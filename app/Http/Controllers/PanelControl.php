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

    //Cierre de venta

    public function cierreVenta($id)
    {
        return view('dashboard/CierreVenta')->with('id', $id);
    }

    public function finalizarVenta($id)
    {

        $venta = TituloVenta::where('id', $id)->first();

        $venta->estado = 'off';
        $venta->save();
        Session::flash('success', 'Venta finalizada');

        return redirect()->back();
    }





    public function actualizarCambio(Request $request)
    {

        $data = EfectivoCambio::where('id_venta', $request->id_venta)
            ->where('tipo', $request->tipo)->first();


        if ($data) {
            $data->centavo_uno = $request->centavo_uno;
            $data->centavo_cinco = $request->centavo_cinco;
            $data->centavo_diez = $request->centavo_diez;
            $data->centavo_veinticinco = $request->centavo_veinticinco;
            $data->dolar_uno = $request->dolar_uno;
            $data->dolar_cinco = $request->dolar_cinco;
            $data->dolar_diez = $request->dolar_diez;
            $data->dolar_veinte = $request->dolar_veinte;

            $data->save();
        }

        Session::flash('success', 'El cambio entregado fue actualizado');

        return redirect()->back();
    }





    public function buscarInventario(Request $request)
    {

        $data = Inventario::join('libro as lb', 'inventario.id_libro', '=', 'lb.id')
            ->select(
                'inventario.*',
                'lb.nombre as nombre_libro'
            )
            ->where('id_venta', $request->id_venta)
            ->where('id_libro', $request->id_libro)
            ->first();
        return json_encode($data);
    }

    public function actualizarInventario(Request $request)
    {

        $data = Inventario::where('id_venta', $request->id_venta)
            ->where('id_libro', $request->id_libro)
            ->first();

        $data->precio = $request->precio;
        $data->descuento = $request->descuento;
        $data->ofrecimiento_a = $request->oa;
        $data->stock += $request->modificacion;
        $data->stock_venta += $request->modificacion;


        Session::flash('success', 'Inventario actualizado');

        return redirect()->back();
    }

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

        $facturasControl = Facturas::select('*')
            ->from('facturascontrol')
            ->where('id_venta', $id)
            ->first();

        $inventario = DB::table('datoventa')
            ->where('id_venta', $id)
            ->orderBy('nombre_libro')
            ->get();

        $cambio = EfectivoCambio::where('id_venta', $id)
            ->where('tipo', '=', 'c')
            ->first();




        return view('dashboard.registroVenta')
            ->with('inventario', $inventario)
            ->with('id', $id)
            ->with('cambio', $cambio)
            ->with('factura', $facturasControl);
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
