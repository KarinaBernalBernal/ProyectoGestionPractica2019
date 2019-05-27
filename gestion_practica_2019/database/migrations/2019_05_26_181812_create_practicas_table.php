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
            $table->increments('id');
            $table->integer('id_alumno')->unsigned();
            $table->date('f_solicitud');
            $table->date('f_inscripcion');
            $table->date('f_desde');
            $table->date('f_hasta');
            $table->string('asist_ch_post_pract', 10);
            $table->string('asist_ch_pre_pract', 10);
            
            $table->timestamps();
            $table->foreign('id_alumno')->references('id')->on('alumnos');
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
