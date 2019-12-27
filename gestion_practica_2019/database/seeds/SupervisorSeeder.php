<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supervisores')->insert([
            'id_supervisor' => '1',
            'nombre' => 'Jorge',
            'apellido_paterno' => 'supervisor',
            'cargo' => 'Jefe de proyectos',
            'departamento' => 'Area informatica',
            'email' => 'jorge.empresa@gmail.com',
            'fono' => '912345678',
            'id_user' => '3',
            'id_empresa' => '1',
        ]);
    }
}
