<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    use HasFactory;

    protected $table = "nota_remision";
    public $timestamps = false;



    static function ruleCreate(): array
    {
        return [
            'representante' => "required",
            'n_remision' => "required ",
            'factura_i' => "required",
            'factura_f' => "required",
            'total_f' => "required",



        ];
    }
    static function attrCreate(): array
    {
        return [
            'representante' => "Encargado",
            'n_remision' => "Nota de remisión",
            'factura_i' => "Factura inicial",
            'factura_f' => "Factura final"

        ];
    }
    static function ruleUpdate(): array
    {
        return [
            'representante' => "required",
            'n_remision' => "required ",
            'factura_i' => "required",
            'factura_f' => "required",


        ];
    }
    static function attrUpdate(): array
    {
        return [
            'representante' => "Encargado",
            'n_remision' => "Nota de remisión",
            'factura_i' => "Factura inicial",
            'factura_f' => "Factura final"

        ];
    }
}
