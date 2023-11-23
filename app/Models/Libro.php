<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    protected $table = "libro";
    public $timestamps = false;

    public function inventario()
    {
        return $this->hasOne(Inventario::class, 'id_libro');
    }

    static function ruleCreate(): array
    {
        return [
            'nombre' => "required",
            'editorial' => 'required'
        ];
    }
    static function attrCreate(): array
    {
        return [
            'nombre' => "Nombre ",
            'editorial' => 'Editorial'
        ];
    }
    static function ruleUpdate(): array
    {
        return [

            'nombre' => "required",
            'editorial' => 'required'
        ];
    }
    static function attrUpdate(): array
    {
        return [
            'nombre' => "Nombre ",
            'editorial' => 'editorial'
        ];
    }
}
