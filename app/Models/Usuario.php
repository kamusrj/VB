<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends User
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = "usuario";
    protected $primaryKey = "correo";
    protected $fillable = [
        'nombre',
        'apellido',
    ];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $hidden = ['clave'];
    public $timestamps = false;


    static function ruleLogin(): array
    {
        return [
            "username" => "required|max:50",
            "password" => "required|max:25|min:4",
        ];
    }
    static function attrLogin(): array
    {
        return [
            "username" => "Nombre de usuario",
            "password" => "Contraseña",
        ];
    }
    static function ruleCreate(): array
    {
        return [
            'correo' => "required|max:30|unique:usuario",
            'clave' => "required|max:20|min:6 ",
            'nombre' => "required",
            'apellido' => "required",
            'rol' => "required"
        ];
    }
    static function attrCreate(): array
    {
        return [
            'correo' => "Nombre de usuario",
            'clave' => "Contraseña",
            'nombre' => "Nombre",
            'apellido' => "Apellido",
            'rol' => "Rol"
        ];
    }
    static function ruleUpdate(): array
    {
        return [

            'nombre' => "required",
            'apellido' => "required",
        ];
    }
    static function attrUpdate(): array
    {
        return [
            'clave' => "Contraseña",
            'nombre' => "Nombre",
            'apellido' => "Apellido",
        ];
    }
}
