<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            'id_empresa' => '1',
            'n_empresa' => 'Agunsa',
            'rut' => '96566940-K',
            'ciudad' => 'Valparaíso',
            'direccion' => 'Urriola 87, Valparaíso',
            'fono' => ' (32) 225 4261',
            'casilla' => '',
            'email' => 'agunsa.empresa@gmail.com',
        ]);

    }
}
