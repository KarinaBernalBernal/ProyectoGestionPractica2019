<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvalActPracticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_act_practicas', function (Blueprint $table) {
            $table->integer('id_autoeval')->unsigned();
            $table->integer('id_actitudinal')->unsigned()->nullable();
            $table->string('eleccion');
            $table->string('criterio');
            $table->timestamps();

            $table->foreign('id_autoeval')->references('id_autoeval')
                    ->on('autoevaluaciones')->onDelete('cascade');
            $table->foreign('id_actitudinal')->references('id_actitudinal')
                    ->on('eval_actitudinales')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eval_act_practicas');
    }
}
