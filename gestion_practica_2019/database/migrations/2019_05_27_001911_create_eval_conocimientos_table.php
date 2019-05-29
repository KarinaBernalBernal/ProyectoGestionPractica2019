<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvalConocimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_conocimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_con');
            $table->string('dp_con');

            $table->timestamps();
        });

        Schema::create('eval_con_practicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_autoeval')->unsigned();
            $table->integer('id_eval_con')->unsigned();

            $table->timestamps();
            $table->foreign('id_autoeval')->references('id')->on('autoevaluaciones');
            $table->foreign('id_eval_con')->references('id')->on('eval_conocimientos');
        });

        Schema::create('eval_con_emp_practicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_practica')->unsigned();
            $table->integer('valor_con_emp_practica');

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
        Schema::dropIfExists('eval_conocimientos');
        Schema::dropIfExists('eval_con_practicas');
        Schema::dropIfExists('eval_con_emp_practicas');
    }
}
