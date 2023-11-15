<?php

namespace App\Http\Controllers;

use App\Models\TituloVenta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelControl extends Controller
{
    use HasFactory;

    public function ListarVentas()
    {

        $ventas = TituloVenta::with(['encargado', 'vendedor'])->get();


        return view('dashboard.panel')->with('ventas', $ventas);
    }
}
