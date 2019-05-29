<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHerramientasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('herramientas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_herramienta');

            $table->timestamps();
        });

        Schema::create('herramientas_practica', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_autoeval')->unsigned();
            $table->integer('id_herramienta')->unsigned();

            $table->timestamps();
            $table->foreign('id_autoeval')->references('id')->on('autoevaluaciones');
            $table->foreign('id_herramienta')->references('id')->on('herramientas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('herramientas');
        Schema::dropIfExists('herramientas_practica');
    }
}
