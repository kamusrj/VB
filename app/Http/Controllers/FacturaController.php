<?php

namespace App\Http\Controllers;

use App\Models\EfectivoCambio;
use App\Models\Facturas;
use App\Models\Institucion;
use App\Models\Libro;
use App\Models\TituloVenta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacturaController extends Controller
{


    public function efectuviCambio($id)
    {
        $tituloVenta = TituloVenta::where('id', $id)->first();

        return view('ventas/EfectivoCambio')->with('tituloVenta', $tituloVenta);
    }

    public function createEfectivo(Request $request)
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
        $ec->total = $request->total;

        $ec->save();

        $id = $request->id_venta;
        $tituloVenta = TituloVenta::where('id', $id)->first();
        $libro = Libro::all();

        return view("ventas/Libros")
            ->with('libro', $libro)
            ->with('tituloVenta', $tituloVenta);
    }





    public function CrearFactura(Request $request)
    {
        Validator::make(
            $request->all(),
            Facturas::ruleCreate()
        )->addCustomAttributes(
            Facturas::attrCreate()
        )->validate();

        $f = new Facturas();
        $f->id_venta = $request->id_venta;

        $f->fecha = Carbon::now()->format('d-m-Y');
        $f->representante = $request->representante;
        $f->n_remision = $request->n_remision;
        $f->factura_i = $request->factura_i;
        $f->factura_f = $request->factura_f;
        $f->total_f = $request->total_f;
        $f->cupon_i = $request->cupon_i;
        $f->cupon_f = $request->cupon_f;
        $f->total_c = $request->tota_c;
        $f->save();
        $data = $f->id_venta;
        return redirect("factura/efectivoCambio/$data");
    }
}
