<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallefactura extends Model
{
    use HasFactory;
    protected $table = "detallefactura";
    public $timestamps = false;


    public function libro()
    {
        return $this->belongsTo(Libro::class, 'id_libro');
    }



    static function ruleCrear(): array
    {
        return [
            'correlativo' => "required|unique:detallefactura,correlativo",
            'padre' => "required",
        ];
    }
    static function attrCrear(): array
    {
        return [
            'correlativo' => "Correlativo",

            'padre' => "Padre",
        ];
    }
    static function ruleActualizar(): array
    {
        return [
            'padre' => "required",
        ];
    }
    static function attrActualizar(): array
    {
        return [
            'correlativo' => "Correlativo",
            'padre' => "Padre",
        ];
    }

    //Factura anulada

    static function ruleAnulada(): array
    {
        return [
            'correlativo' => "required|unique:detallefactura,correlativo",
            'motivo' => "required",
        ];
    }
    static function attrAnulada(): array
    {
        return [
            'correlativo' => "Correlativo",

            'motivo' => "Motivo de anulación",
        ];
    }
}
