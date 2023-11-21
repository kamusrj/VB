<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TituloVenta extends Model
{
    use HasFactory;


    protected $table = "titulo_venta";
    protected $fillable = ['id'];
    public $timestamps = false;


    static function ruleCrear(): array
    {
        return [
            'director' => "required",
            'encargado' => "required",
            'telefono' => "required",
            'vendedor' => "required",
            'zona' => "required",
            'direccion' => "required",
        ];
    }
    static function attrCrear(): array
    {
        return [
            'director' => "Director / Responsable",
            'encargado' => "Operador",
            'telefono' => "Teléfono",
            'vendedor' => "Vendedor",
            'zona' => "Zona",
            'direccion' => "Dirección",
        ];
    }
    static function ruleActualizar(): array
    {
        return [
            'director' => "required",
            'encargado' => "required",
            'telefono' => "required|min:8",
            'vendedor' => "required",
            'zona' => "required",
            'direccion' => "required|min:8",
        ];
    }
    static function attrActualizar(): array
    {
        return [
            'director' => "Director / Responsable",
            'encargado' => "Operador",
            'telefono' => "Teléfono",
            'vendedor' => "Vendedor",
            'zona' => "Zona",
            'direccion' => "Dirección",
        ];
    }
}
