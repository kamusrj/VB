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


    static function ruleCreate(): array
    {
        return [
         
            'institucion' => "required",
            'director' => "required",
            'encargado' => "required",
            'telefono' => "required",
            'vendedor' => "required",
            'zona' => "required",
            'direccion' => "required",
        ];
    }
    static function attrCreate(): array
    {
        return [
    
            'institucion' => "Institución",
            'director' => "Director / Responsable",
            'encargado' => "Operador",
            'telefono' => "Teléfono",
            'vendedor' => "Vendedor",
            'zona' => "Zona",
            'direccion' => "Dirección",
        ];
    }
    static function ruleUpdate(): array
    {
        return [
            'institucion' => "required",
            'director' => "required",
            'encargado' => "required",
            'telefono' => "required|min:8",
            'vendedor' => "required",
            'zona' => "required",
            'direccion' => "required|min:8",
        ];
    }
    static function attrUpdate(): array
    {
        return [
            'institucion' => "Institución",
            'director' => "Director / Responsable",
            'encargado' => "Operador",
            'telefono' => "Teléfono",
            'vendedor' => "Vendedor",
            'zona' => "Zona",
            'direccion' => "Dirección",
        ];
    }
}
