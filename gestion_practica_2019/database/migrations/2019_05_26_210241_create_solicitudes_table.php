<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id_solicitud');
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('rut');
            $table->string('direccion');
            $table->string('fono');
            $table->string('anno_ingreso');
            $table->string('carrera');
            $table->string('semestre_proyecto');
            $table->string('anno_proyecto');
            $table->date('f_solicitud');
            $table->string('resolucion_solicitud')->nullable();
            $table->string('observacion_solicitud')->nullable();
            $table->integer('estado')->default(0);

            $table->integer('id_alumno')->unsigned()->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('solicitudes');
    }
}
