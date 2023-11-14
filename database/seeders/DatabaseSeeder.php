<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('usuario')->insert([
            [
                'correo' => 'Kamus5',
                'clave' => Hash::make('1234'),
                'nombre' => 'Antonio',
                'apellido' => 'Hernández',
                'rol' => 'c'
            ],
            [
                'correo' => 'kamus7',
                'clave' => Hash::make('1234'),
                'nombre' => 'Antonio',
                'apellido' => 'Hernández',
                'rol' => 'b'
            ],
            [
                'correo' => 'usuario3',
                'clave' => Hash::make('password3'),
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'rol' => 'a'
            ],
            [
                'correo' => 'usuario4',
                'clave' => Hash::make('password4'),
                'nombre' => 'Maria',
                'apellido' => 'Gómez',
                'rol' => 'g'
            ],
            [
                'correo' => 'usuario5',
                'clave' => Hash::make('password5'),
                'nombre' => 'Luis',
                'apellido' => 'Martínez',
                'rol' => 'c'
            ],
            [
                'correo' => 'usuario6',
                'clave' => Hash::make('password6'),
                'nombre' => 'Ana',
                'apellido' => 'Rodriguez',
                'rol' => 'a'
            ],
            [
                'correo' => 'usuario7',
                'clave' => Hash::make('password7'),
                'nombre' => 'Pedro',
                'apellido' => 'López',
                'rol' => 'b'
            ],
            [
                'correo' => 'usuario8',
                'clave' => Hash::make('password8'),
                'nombre' => 'Laura',
                'apellido' => 'Sánchez',
                'rol' => 'c'
            ],
            [
                'correo' => 'usuario9',
                'clave' => Hash::make('password9'),
                'nombre' => 'Miguel',
                'apellido' => 'González',
                'rol' => 'g'
            ],
            [
                'correo' => 'usuario10',
                'clave' => Hash::make('password10'),
                'nombre' => 'Carmen',
                'apellido' => 'Díaz',
                'rol' => 'a'
            ]
        ]);
    }
}
