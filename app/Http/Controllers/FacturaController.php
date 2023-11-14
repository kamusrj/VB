<?php

namespace App\Http\Controllers;

use App\Models\Facturas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacturaController extends Controller
{


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
