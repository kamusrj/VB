<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;



    protected $table = "inventario";
    protected $fillable = ['stock', 'precio', 'descuento', 'ofrecimiento_a', 'fecha_inicio'];
    public $timestamps = false;



    static function ruleCreate(): array
    {
        return [
            'fecha' => 'required',
        ];
    }
    static function attrCreate(): array
    {
        return [
          'stock[]' => 'Cantidad',
            'precio[]' => 'Precio',
            'fecha' => 'fecha de inicio',
        ];
    }
    static function ruleUpdate(): array
    {
        return [
            'stock' => 'required',
            'precio' => 'required'

        ];
    }
    static function attrUpdate(): array
    {
        return [

            'stock' => 'cantidad ',
            'precio' => 'Precio'
        ];
    }
}
