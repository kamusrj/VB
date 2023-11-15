<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelControl extends Model
{
    use HasFactory;

    public function ListarVentas()
    {



        return view('dashboard.panel');
    }
}
