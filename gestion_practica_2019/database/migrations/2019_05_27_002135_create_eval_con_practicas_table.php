<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvalConPracticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_con_practicas', function (Blueprint $table) {
            $table->integer('id_autoeval')->unsigned();
            $table->integer('id_conocimiento')->unsigned();
            $table->integer('vigencia')->default(1);
            $table->string('valor_con_practica');

            $table->timestamps();
            $table->foreign('id_autoeval')->references('id_autoeval')
                    ->on('autoevaluaciones')->onDelete('cascade');
            $table->foreign('id_conocimiento')->references('id_conocimiento')
                    ->on('eval_conocimientos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eval_con_practicas');
    }
}
