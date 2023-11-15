<?php

namespace App\Http\Controllers;

use App\Models\TituloVenta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PanelControl extends Controller
{
    use HasFactory;

    public function ListarVentas()
    {

        $ventas = TituloVenta::join('usuario as enc', 'titulo_venta.encargado', '=', 'enc.correo')
            ->join('usuario as ven', 'titulo_venta.vendedor', '=', 'ven.correo')
            ->select(
                'titulo_venta.*',
                'enc.nombre as nombre_encargado',
                'enc.apellido as apellido_encargado',
                'ven.nombre as nombre_vendedor',
                'ven.apellido as apellido_vendedor'
            )
            ->get();

        return view('dashboard.panel')->with('ventas', $ventas);
    }
}
