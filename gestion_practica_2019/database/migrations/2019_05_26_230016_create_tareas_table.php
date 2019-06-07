<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('id_tarea');
            $table->string('n_tarea');
            $table->string('dp_tarea');

            $table->integer('id_autoeval')->unsigned();
            $table->timestamps();

            $table->foreign('id_autoeval')->references('id_autoeval')
                    ->on('autoevaluaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
