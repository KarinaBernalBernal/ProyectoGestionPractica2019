<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvalActitudinalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_actitudinales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_actitud');
            $table->string('dp_actitud');

            $table->timestamps();
        });

        Schema::create('eval_act_practicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_autoeval')->unsigned();
            $table->integer('id_eval_act')->unsigned();

            $table->timestamps();
            $table->foreign('id_autoeval')->references('id')->on('autoevaluaciones');
            $table->foreign('id_eval_act')->references('id')->on('eval_act_practicas');
        });

        Schema::create('eval_act_emp_practica', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_practica')->unsigned();
            $table->integer('valor_act_emp_practica');

            $table->timestamps();
            $table->foreign('id_practica')->references('id')->on('practicas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eval_actitudinales');
        Schema::dropIfExists('eval_act_practicas');
        Schema::dropIfExists('eval_act_emp_practica');
    }
}
