<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administradores')->insert([
            'id_admin' => '1',
            'nombre' => 'Ivan',
            'apellido_paterno' => 'Mercado',
            'apellido_materno' => 'Bermúdez',
            'rut' => '10064872-5',
            'email' => 'ivan.mercado@mail.pucv.cl',
            'cargo' => 'Profesor',
            'id_user' => '1',
        ]);
    }
}
