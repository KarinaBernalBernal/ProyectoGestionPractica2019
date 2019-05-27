<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesempennosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desempennos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_autoeval')->unsigned();
            $table->string('valor');
            $table->string('dp_tarea');

            $table->timestamps();
            $table->foreign('id_autoeval')->references('id')->on('autoevaluaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desempennos');
    }
}
