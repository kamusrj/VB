<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EfectivoCambio extends Model
{
    use HasFactory;

    protected $table = "efectivo_c";
    public $timestamps = false;


    static function ruleCreate(): array
    {
        return [
            'centavo_uno' => "required",
            'centavo_cinco' => "required ",
            'centavo_diez' => "required",
            'centavo_veinticinco' => "required",
            'dolar_uno' => "required",
            'dolar_cinco' => "required ",
            'dolar_diez' => "required",
            'dolar_veinte' => "required",

        ];
    }
    static function attrCreate(): array
    {
        return [
            'centavo_uno' => "campo 0.01",
            'centavo_cinco' => "campo 0.05",
            'centavo_diez' => "campo 0.10",
            'centavo_veinticinco' => "campo 0.25",
            'dolar_uno' => "campo 1.00",
            'dolar_cinco' => "campo 5.00 ",
            'dolar_diez' => "campo 10.00",
            'dolar_veinte' => "campo 20.00",

        ];
    }
    static function ruleUpdate(): array
    {
        return [
            'centavo_uno' => "required",
            'centavo_cinco' => "required ",
            'centavo_diez	' => "required",
            'centavo_veinticinco' => "required",
            'dolar_uno' => "required",
            'dolar_cinco' => "required ",
            'dolar_diez	' => "required",
            'doral_veinte' => "required",


        ];
    }
    static function attrUpdate(): array
    {
        return [
            'centavo_uno' => "campo 0.01",
            'centavo_cinco' => "campo 0.05",
            'centavo_diez	' => "campo 0.10",
            'centavo_veinticinco' => "campo 0.25",
            'dolar_uno' => "campo 1.00",
            'dolar_cinco' => "campo 5.00 ",
            'dolar_diez	' => "campo 10.00",
            'doral_veinte' => "campo 20.00",

        ];
    }
}
