<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resoluciones', function (Blueprint $table) {
            $table->increments('id_resolucion');
            $table->date('f_resolucion');
            $table->string('observacion_resolucion');
            $table->boolean('resolucion_practica');

            $table->integer('id_practica')->unsigned()->unique();
            $table->integer('id_admin')->unsigned();
            $table->timestamps();

            $table->foreign('id_practica')->references('id_practica')
                    ->on('practicas')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_admin')
                    ->on('administradores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resoluciones');
    }
}
