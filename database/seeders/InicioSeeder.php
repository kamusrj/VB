<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //usuario
        DB::table('usuario')->insert(
            [
                [
                    'correo' => 'kamus',
                    'clave' => Hash::make('1234'),
                    'nombre' => 'Usuario',
                    'apellido' => 'Uno',
                    'rol' => 'a',
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
                    'rol' => 'v'
                ],
                [
                    'correo' => 'usuario4',
                    'clave' => Hash::make('password4'),
                    'nombre' => 'Maria',
                    'apellido' => 'Gómez',
                    'rol' => 'v'
                ],
                [
                    'correo' => 'usuario5',
                    'clave' => Hash::make('password5'),
                    'nombre' => 'Luis',
                    'apellido' => 'Martínez',
                    'rol' => 'v'
                ],
                [
                    'correo' => 'usuario6',
                    'clave' => Hash::make('password6'),
                    'nombre' => 'Ana',
                    'apellido' => 'Rodriguez',
                    'rol' => 'b'
                ],
                [
                    'correo' => 'usuario7',
                    'clave' => Hash::make('password7'),
                    'nombre' => 'Pedro',
                    'apellido' => 'López',
                    'rol' => 'c'
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
                    'rol' => 'b'
                ]
            ]
        );


        DB::table('libro')->insert([[
            'nombre' => 'Libro 1',
            'editorial' => 'ed',
            'descripcion' => 'Descripción del libro 1',
        ], [
            'nombre' => 'Libro 2',
            'editorial' => 'mdf',
            'descripcion' => 'Descripción del libro 1',
        ], [
            'nombre' => 'Libro 3',
            'editorial' => 'eng',
            'descripcion' => 'Descripción del libro 1',
        ]]);

        DB::table('institucion')->insert([[
            'codigo' => '00001',
            'nombre' => 'edisal',
            'estado' => 'off',

        ], [
            'codigo' => '12345',
            'nombre' => 'Institucion 2',
            'estado' => 'off',

        ], [
            'codigo' => '12346',
            'nombre' => 'Institucion 3',
            'estado' => 'off',

        ], [
            'codigo' => '12347',
            'nombre' => 'Institucion 4',
            'estado' => 'off',

        ], [
            'codigo' => '12348',
            'nombre' => 'Institucion 5',
            'estado' => 'off',

        ], [
            'codigo' => '12349',
            'nombre' => 'Institucion 2',
            'estado' => 'off',

        ], [
            'codigo' => '12350',
            'nombre' => 'Institucion 1',
            'estado' => 'off',

        ], [
            'codigo' => '12351',
            'nombre' => 'Institucion 2',
            'estado' => 'off',

        ], [
            'codigo' => '12352',
            'nombre' => 'Institucion 1',
            'estado' => 'off',

        ]]);
    }
}
