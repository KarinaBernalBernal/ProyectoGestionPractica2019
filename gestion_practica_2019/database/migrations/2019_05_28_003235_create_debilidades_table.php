<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debilidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_debilidad');
            $table->string('dp_debilidad');
            $table->integer('id_practica')->unsigned();
            $table->foreign('id_practica')->references('id')->on('practicas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debilidades');
    }
}
