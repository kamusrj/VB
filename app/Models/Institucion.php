<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;
    protected $table = "institucion";
    protected $primaryKey = "codigo";
    public $incrementing = false;

    public $timestamps = false;

    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'libro_escuela', 'escuela_id', 'libro_id');
    }
    static function ruleCreate(): array
    {
        return [
            'codigo' => "required|max:10|min:5",
            'nombre' => "required",
        ];
    }
    static function attrCreate(): array
    {
        return [
            'codigo' => "Codigo institucional",
            'nombre' => "Nombre",
        ];
    }
    static function ruleUpdate(): array
    {
        return [
            'nombre' => "required",
        ];
    }
    static function attrUpdate(): array
    {
        return [
            'nombre' => "Nombre",
        ];
    }
}
