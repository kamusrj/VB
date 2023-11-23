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
        return view('dashboard/facturasControl')
            ->with('inventario', $inventario)
            ->with('facturas', $facturas);
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

            $in = new Detallefactura();
            $in->id_venta = $request->id_venta;
            $in->fecha = date('Y-m-d');
            $in->id_libro = $libro_id;
            $in->correlativo = $request->correlativo;
            $in->padre = $request->padre;
            $in->hora = date("h:i A", time());

            $in->save();
        }

        dd($in);
        Session::flash('success', 'Factura guardada');
        return redirect()->back();
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
