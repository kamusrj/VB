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
        $detalleFactura = Detallefactura::where('id_venta', $id)->get();
        $dt =  $detalleFactura->unique('correlativo');
        return view('dashboard/facturasControl')
            ->with('inventario', $inventario)
            ->with('facturas', $facturas)
            ->with('id', $id)
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
            $dt->hora = date("H:i");
            $dt->save();

            $dt->concepto = 'venta';

            $inventario = Inventario::where('id_venta', $request->id_venta)
                ->where('id_libro', $libro_id)
                ->first();

            if ($inventario) {
                $inventario->decrement('stock_venta', $request->cantidad[$libro_id]);
            }
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
            ->where('inv.id_venta', $request->id)
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
<<<<<<< HEAD

=======
<<<<<<< HEAD
>>>>>>> parent of ee85033 (Revert "el kamus imortal")
        $ec = new EfectivoCambio();

        $ec->id_venta = $request->id_venta;
<<<<<<< HEAD
        $ec->tipo = $request->tipo;
=======
=======
        
        $ec = new EfectivoCambio();
        $ec->id_venta = $request->id_venta;
        $ec->tipo = 'c';
>>>>>>> parent of b8c6738 (update 29/11/2023)
>>>>>>> parent of ee85033 (Revert "el kamus imortal")
        $ec->fecha = date('d-m-Y');
        $ec->centavo_uno = $request->centavo_uno;
        $ec->centavo_cinco = $request->centavo_cinco;
        $ec->centavo_diez = $request->centavo_diez;
        $ec->centavo_veinticinco = $request->centavo_veinticinco;
        $ec->dolar_uno = $request->dolar_uno;
        $ec->dolar_cinco = $request->dolar_cinco;
        $ec->dolar_diez = $request->dolar_diez;
        $ec->dolar_veinte = $request->dolar_veinte;
        $ec->dolar_cincuenta =$request->dolar_cincuenta ?? 0;
        $ec->dolar_cien = $request->dolar_cien  ?? 0;
        $ec->save();
        $id = $request->id_venta;

        if ($request->tipo === 'c') {
            return redirect("venta/libros/" . $id);
        } else {
            return redirect()->back();
        }
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

        $f->factura_i = str_pad($request->factura_i, 5, '0', STR_PAD_LEFT);
        $f->factura_f = str_pad($request->factura_f, 5, '0', STR_PAD_LEFT);


        $f->cupon_i = $request->cupon_i;
        $f->cupon_f = $request->cupon_f;
        $f->save();
        $data = $f->id_venta;
        return redirect("factura/efectivoCambio/$data");
    }
}
