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
            $table->increments('id');
            $table->integer('id_autoeval')->unsigned();
            $table->integer('id_eval_act')->unsigned();

            $table->timestamps();
            $table->foreign('id_autoeval')->references('id')->on('autoevaluaciones');
            $table->foreign('id_eval_act')->references('id')->on('eval_act_practicas');
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
