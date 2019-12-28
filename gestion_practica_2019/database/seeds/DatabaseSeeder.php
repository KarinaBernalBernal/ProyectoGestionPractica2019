<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AdministradorSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(AlumnoSeeder::class);
        $this->call(SupervisorSeeder::class);
    }
}
