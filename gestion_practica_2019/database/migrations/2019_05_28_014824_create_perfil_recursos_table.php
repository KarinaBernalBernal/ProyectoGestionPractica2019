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
            $table->integer('id_perfil')->unsigned();
            $table->integer('id_recurso')->unsigned();
            $table->timestamps();

            $table->foreign('id_perfil')->references('id_perfil')
                    ->on('perfiles')->onDelete('cascade');
            $table->foreign('id_recurso')->references('id_recurso')
                    ->on('recursos')->onDelete('cascade');
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
