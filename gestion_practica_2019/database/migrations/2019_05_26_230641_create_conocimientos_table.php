<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConocimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conocimientos', function (Blueprint $table) {
            $table->increments('id_conocimiento');
            $table->string('n_conocimiento');
            $table->string('dp_conocimiento');
            $table->string('tipo_conocimiento');

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
        Schema::dropIfExists('conocimientos');
    }
}
