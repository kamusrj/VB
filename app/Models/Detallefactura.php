<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallefactura extends Model
{
    use HasFactory;
    protected $table = "detallefactura";
    public $timestamps = false;

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
}
