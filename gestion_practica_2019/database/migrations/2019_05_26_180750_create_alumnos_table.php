<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id_alumno');
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('rut');
            $table->string('email');
            $table->string('direccion');
            $table->string('fono');
            $table->string('anno_ingreso');
            $table->string('carrera');
            $table->string('estimacion_semestre');
        
            $table->integer('id_user')->unsigned(); //Esto es debido a que no se puede crear una herencia
            $table->timestamps();
            
            $table->foreign('id_user')->references('id_user')
                    ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
