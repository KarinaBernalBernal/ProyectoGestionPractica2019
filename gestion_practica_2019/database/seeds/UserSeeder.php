<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id_user' => '1',
                'name' => 'Ivan',
                'email' => 'ivan.mercado@mail.pucv.cl',
                'password' => bcrypt('ivanadmin'),
                'type' => 'administrador',],
            [
                'id_user' => '2',
                'name' => 'Eric',
                'email' => 'eric.riveros.n@mail.pucv.cl',
                'password' => bcrypt('ericalum'),
                'type' => 'alumno',
            ],
            [
                'id_user' => '3',
                'name' => 'Jorge',
                'email' => 'jorge.empresa@gmail.com',
                'password' => bcrypt('jorge123'),
                'type' => 'supervisor',
            ]
        ];
        DB::table('users')->insert($data);

    }
}