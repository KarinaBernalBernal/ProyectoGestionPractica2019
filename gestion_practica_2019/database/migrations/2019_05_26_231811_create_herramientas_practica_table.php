<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHerramientasPracticaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('herramientas_practica', function (Blueprint $table) {
            $table->integer('id_autoeval')->unsigned();
            $table->integer('id_herramienta')->unsigned();
            $table->timestamps();

            $table->foreign('id_autoeval')->references('id_autoeval')
                    ->on('autoevaluaciones')->onDelete('cascade');
            $table->foreign('id_herramienta')->references('id_herramienta')
                    ->on('herramientas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('herramientas_practica');
    }
}
