<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alumnos')->insert([
            'id_alumno' => '1',
            'nombre' => 'Eric Felipe',
            'apellido_paterno' => 'Riveros',
            'apellido_materno' => 'Novoa',
            'rut' => '19110859-0',
            'email' => 'eric.riveros.n@mail.pucv.cl',
            'direccion' => 'Calle 9 con 23 Norte, Viña del Mar',
            'fono' => '987496635',
            'anno_ingreso' => '2014',
            'carrera' => 'Ingenieria de Ejecución en informatica',
            'estimacion_semestre' => '2do semestre 2019',
            'id_user' => '2',
        ]);
    }
}
