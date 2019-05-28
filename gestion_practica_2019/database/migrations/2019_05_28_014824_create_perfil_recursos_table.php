<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_recursos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_perfil')->unsigned();
            $table->integer('id_recurso')->unsigned();
            $table->foreign('id_perfil')->references('id')->on('perfiles');
            $table->foreign('id_recurso')->references('id')->on('recursos');
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
        Schema::dropIfExists('perfil_recursos');
    }
}
