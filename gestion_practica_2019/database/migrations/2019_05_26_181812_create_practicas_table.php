<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreatePracticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practicas', function (Blueprint $table) {
            $table->increments('id_practica');
            $table->date('f_solicitud');
            $table->date('f_inscripcion')->nullable();
            $table->date('f_desde')->nullable();
            $table->date('f_hasta')->nullable();
            $table->string('asist_ch_post_pract', 10)->nullable();

            $table->integer('id_alumno')->unsigned();
            $table->integer('id_supervisor')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('id_supervisor')->references('id_supervisor')
                ->on('supervisores')->onDelete('cascade');
            $table->foreign('id_alumno')->references('id_alumno')
                ->on('alumnos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practicas');
    }
}