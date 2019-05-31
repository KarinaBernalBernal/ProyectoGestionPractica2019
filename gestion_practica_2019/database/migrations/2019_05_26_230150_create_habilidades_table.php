<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habilidades', function (Blueprint $table) {
            $table->increments('id_habilidad');
            $table->string('n_habilidad');
            $table->string('dp_habilidad');
            $table->string('tipo_habilidad');

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
        Schema::dropIfExists('habilidades');
    }
}
