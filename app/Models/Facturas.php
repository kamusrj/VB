<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    use HasFactory;

    protected $table = "nota_remision";
    public $timestamps = false;



    static function ruleCrear(): array
    {
        return [
            'representante' => "required",
            'n_remision' => "required ",
            'fecha_programada' => "required",
            'factura_i' => "required",
            'factura_f' => "required",
        ];
    }
    static function attrCrear(): array
    {
        return [
            'representante' => "Encargado Departamento de crédito",
            'encargado' => "Encargado de venta ",
            'fecha_programada'=>"Fecha de venta ",
            'n_remision' => "Nota de remisión",
            'factura_i' => "Factura inicial",
            'factura_f' => "Factura final"
        ];
    }
    static function ruleActualizar(): array
    {
        return [
            'representante' => "required",

            'n_remision' => "required ",
            'factura_i' => "required",
            'factura_f' => "required",


        ];
    }
    static function attrActualizar(): array
    {
        return [
            'representante' => "Encargado Departamento de crédito",
            'encargado' => "Encargado de venta",
            'n_remision' => "Nota de remisión",
            'factura_i' => "Factura inicial",
            'factura_f' => "Factura final"

        ];
    }
}
