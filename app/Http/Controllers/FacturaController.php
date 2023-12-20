<?php

namespace App\Http\Controllers;

use App\Models\Detallefactura;
use App\Models\EfectivoCambio;
use App\Models\Facturas;
use App\Models\Inventario;
use App\Models\TituloVenta;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FacturaController extends Controller
{

    //gestion de facturas 

    public function listarFacturas($id, $fecha)
    {
        //modal
        $inventario = Inventario::join('titulo_venta as tv', 'inventario.id_venta', '=', 'tv.id')
            ->join('libro', 'inventario.id_libro', '=', 'libro.id')
            ->where('tv.id', '=', $id)
            ->where('fecha', $fecha)
            ->where('stock_venta', '>', 0)
            ->select(
                'inventario.*',
                'libro.nombre as nombre_libro'
            )
            ->orderBy('nombre_libro')
            ->get();
        $facturas = Facturas::where('id_venta', $id)
            ->where('fecha_programada', $fecha)
            ->get();

        $detalleFactura = Detallefactura::where('id_venta', $id)
            ->where('fecha_programada', $fecha)
            ->orderBy('correlativo', 'asc')->get();

        $dt =  $detalleFactura->unique('correlativo');
        return view('dashboard/facturasControl')
            ->with('inventario', $inventario)
            ->with('facturas', $facturas)
            ->with('id', $id)
            ->with('detalle', $dt)
            ->with('fecha', $fecha);
    }

    public function guardarFactura(Request $request)
    {
        if ($request->anulada === 'on') {
            Validator::make(
                $request->all(),
                Detallefactura::ruleAnulada()
            )->addCustomAttributes(
                Detallefactura::attrAnulada()
            )->validate();
            $dt = new Detallefactura();
            $dt->id_venta = $request->id_venta;
            $dt->correlativo = $request->correlativo;
            $dt->fecha_programada = $request->fecha;
            $dt->anulada = 'si';
            $dt->motivo = $request->motivo;
            $dt->fecha = date('Y-m-d');
            $dt->hora = date("H:i");
            $dt->save();
        } else {
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
                $dt->fecha_programada = $request->fecha;
                $dt->fecha = date('Y-m-d');
                $dt->hora = date("H:i");
                $dt->total = $request->totalFactura;
                $dt->save();
                $dt->concepto = 'venta';
                $inventario = Inventario::where('id_venta', $request->id_venta)
                    ->where('id_libro', $libro_id)
                    ->first();
                if ($inventario) {
                    $inventario->decrement('stock_venta', $request->cantidad[$libro_id]);
                }
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
            ->where('inv.fecha', $request->fecha)
            ->where('correlativo', $request->correlativo)
            ->get();
        return json_encode($data);
    }

    //cracion de venta diracta
    public function EfectivoCambio($id, $fecha)
    {
        $tituloVenta = TituloVenta::where('id', $id)->first();
        return view('ventas/EfectivoCambio')
            ->with('tituloVenta', $tituloVenta)
            ->with('fecha', $fecha);
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
        $ec->tipo = $request->tipo;
        $ec->fecha = $request->fecha;
        $ec->centavo_uno = $request->centavo_uno ?? 0;
        $ec->centavo_cinco = $request->centavo_cinco ?? 0;
        $ec->centavo_diez = $request->centavo_diez ?? 0;
        $ec->centavo_veinticinco = $request->centavo_veinticinco ?? 0;
        $ec->dolar_uno = $request->dolar_uno ?? 0;
        $ec->dolar_cinco = $request->dolar_cinco ?? 0;
        $ec->dolar_diez = $request->dolar_diez ?? 0;
        $ec->dolar_veinte = $request->dolar_veinte ?? 0;
        $ec->dolar_cincuenta = $request->dolar_cincuenta ?? 0;
        $ec->dolar_cien = $request->dolar_cien  ?? 0;
        $ec->total = $request->totalFactura ?? 0;
        $ec->save();
        $id = $request->id_venta;
        if ($request->tipo === 'c') {
            return redirect("venta/libros/$id/$request->fecha");
        } else {
            Session::flash('success', 'Reporte Entregado');
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
        $f->fecha_programada = $request->fecha_programada;
        $f->fecha = date("Y-m-d");
        $f->representante = $request->representante;
        $f->n_remision = $request->n_remision;
        $f->encargado = $request->encargado;
        $f->estado = 'on';
        $f->factura_i = str_pad($request->factura_i, 5, '0', STR_PAD_LEFT);
        $f->factura_f = str_pad($request->factura_f, 5, '0', STR_PAD_LEFT);
        $f->cupon_i = $request->cupon_i;
        $f->cupon_f = $request->cupon_f;
        $f->save();
        $data = $f->id_venta;
        $fecha =  $request->fecha_programada;
        Usuario::where('correo', $request->encargado)->update(['estado' => 'off']);
        return redirect("factura/efectivoCambio/$data/$fecha");
    }
    public function retornoCambio(Request $request)
    {


        $ec = new EfectivoCambio();
        $ec->id_venta = $request->id_venta;
        $ec->fecha = $request->fecha;
        $ec->tipo = $request->tipo;
        $ec->centavo_uno = $request->Vcentavo_uno;
        $ec->centavo_cinco = $request->Vcentavo_cinco;
        $ec->centavo_diez = $request->Vcentavo_diez;
        $ec->centavo_veinticinco = $request->Vcentavo_veinticinco;
        $ec->dolar_uno = $request->Vdolar_uno;
        $ec->dolar_cinco = $request->Vdolar_cinco;
        $ec->dolar_diez = $request->Vdolar_diez;
        $ec->dolar_veinte = $request->Vdolar_veinte;
        $ec->dolar_cincuenta = $request->Vdolar_cincuenta ?? 0;
        $ec->dolar_cien = $request->Vdolar_cien  ?? 0;
        $ec->total = $request->totalRetorno ?? 0;
        $ec->save();
        Session::flash('success', 'Reporte Entregado');
        return redirect()->back();
    }
}
