<?php

namespace App\Http\Controllers;

use App\Models\Detallefactura;
use App\Models\EfectivoCambio;
use App\Models\Facturas;
use App\Models\Institucion;
use App\Models\Inventario;
use App\Models\Libro;
use App\Models\TituloVenta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FacturaController extends Controller
{

    //gestion de facturas 

    public function listarFacturas($id)
    {

        //modal
        $inventario = Inventario::join('titulo_venta as tv', 'inventario.id_venta', '=', 'tv.id')
            ->join('libro', 'inventario.id_libro', '=', 'libro.id')
            ->where('tv.id', '=', $id)
            ->select(
                'inventario.*',
                'libro.nombre as nombre_libro'
            )
            ->get();
        $facturas = Facturas::where('id_venta', $id)->get();


        //llenar tabla
        $detalleFactura = Detallefactura::all();
        $totalPorLibro = [];

        foreach ($detalleFactura as $detalle) {
            $libroId = $detalle->id_libro;
            $precio = $detalle->precio;
            $cantidad = $detalle->cantidad;       
            $total = $precio * $cantidad;
            $totalPorLibro[$libroId] = $total;
        }


        $dt =  $detalleFactura->unique('correlativo');


        return view('dashboard/facturasControl')
            ->with('inventario', $inventario)
            ->with('facturas', $facturas)
            ->with('detalle', $dt);
    }


    public function guardarFactura(Request $request)
    {

        Validator::make(
            $request->all(),
            Detallefactura::ruleCrear()
        )->addCustomAttributes(
            Detallefactura::attrCrear()
        )->validate();

        $libros = $request->input('libros_seleccionados', []);

        foreach ($libros as $libro_id) {
            $dt = new Detallefactura();
            $dt->id_venta = $request->id_venta;
            $dt->correlativo = $request->correlativo;
            $dt->id_libro = $libro_id;
            $dt->cantidad = $request->cantidad[$libro_id];
            $dt->padre = $request->padre;
            $dt->fecha = date('Y-m-d');
            $dt->hora = date("H:i A", time());
            $dt->save();
        }


        Session::flash('success', 'Factura guardada');
        return redirect()->back();
    }



    public function facturaBuscar(Request $request)
    {
        $data = Detallefactura::join('titulo_venta as tv', 'detallefactura.id_venta', '=', 'tv.id')
            ->join('libro as lb', 'detallefactura.id_libro', '=', 'lb.id')
            ->join('inventario as inv', 'lb.id', '=', 'inv.id_libro')
            ->select(
                'detallefactura.*',
                'lb.nombre as nombre_libro',
                'inv.precio as precio_libro'
            )
            ->where('correlativo', $request->correlativo)
            ->get();
        return json_encode($data);
    }








    //cracion de venta diracta
    public function EfectivoCambio($id)
    {
        $tituloVenta = TituloVenta::where('id', $id)->first();
        return view('ventas/EfectivoCambio')->with('tituloVenta', $tituloVenta);
    }
    public function CrearEfectivo(Request $request)
    {
        Validator::make(
            $request->all(),
            EfectivoCambio::ruleCreate()
        )->addCustomAttributes(
            EfectivoCambio::attrCreate()
        )->validate();
        $ec = new EfectivoCambio();
        $ec->id_venta = $request->id_venta;
        $ec->fecha = date('d-m-Y');
        $ec->centavo_uno = $request->centavo_uno;
        $ec->centavo_cinco = $request->centavo_cinco;
        $ec->centavo_diez = $request->centavo_diez;
        $ec->centavo_veinticinco = $request->centavo_veinticinco;
        $ec->dolar_uno = $request->dolar_uno;
        $ec->dolar_cinco = $request->dolar_cinco;
        $ec->dolar_diez = $request->dolar_diez;
        $ec->dolar_veinte = $request->dolar_veinte;
        $ec->save();
        $id = $request->id_venta;
        return redirect("venta/libros/" . $id);
    }

    public function CrearFactura(Request $request)
    {
        Validator::make(
            $request->all(),
            Facturas::ruleCrear()
        )->addCustomAttributes(
            Facturas::attrCrear()
        )->validate();

        $f = new Facturas();
        $f->id_venta = $request->id_venta;
        $f->fecha = date("Y-m-d");
        $f->representante = $request->representante;
        $f->n_remision = $request->n_remision;
        $f->factura_i = $request->factura_i;
        $f->factura_f = $request->factura_f;
        $f->cupon_i = $request->cupon_i;
        $f->cupon_f = $request->cupon_f;
        $f->save();
        $data = $f->id_venta;
        return redirect("factura/efectivoCambio/$data");
    }
}
