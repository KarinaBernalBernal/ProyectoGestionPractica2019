<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroContactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_contacto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_supervisor')->unsigned();
            $table->integer('id_admin')->unsigned();
            $table->string('tipo_contacto');
            $table->integer('cant_contacto');
            $table->string('observacion_contacto');
            $table->date('f_contacto');

            $table->timestamps();
            $table->foreign('id_supervisor')->references('id')->on('supervisores');
            $table->foreign('id_admin')->references('id')->on('administradores');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_contacto');
    }
}
