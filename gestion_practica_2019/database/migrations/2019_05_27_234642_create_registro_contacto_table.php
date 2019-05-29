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
            $table->integer('id_practica')->unsigned(); //PK, FK
            $table->primary('id_practica');

            $table->string('tipo_contacto');
            $table->integer('cant_contacto');
            $table->string('observacion_contacto');
            $table->date('f_contacto');

            $table->integer('id_supervisor')->unsigned();
            $table->integer('id_admin')->unsigned();
            $table->timestamps();

            $table->foreign('id_practica')->references('id_practica')
                    ->on('practicas')->onDelete('cascade');
            $table->foreign('id_supervisor')->references('id_supervisor')
                    ->on('supervisores')->onDelete('cascade');
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
        Schema::dropIfExists('registro_contacto');
    }
}
