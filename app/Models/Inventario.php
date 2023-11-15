<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;



    protected $table = "inventario";
    public $timestamps = false;



    static function ruleCreate(): array
    {
        return [
            'id_libro' => "required",

        ];
    }
    static function attrCreate(): array
    {
        return [
            'id_libro' => "Libro",

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
