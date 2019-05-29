<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvalConEmpPracticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_con_emp_practicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valor_con_emp_practica');

            $table->integer('id_practica')->unsigned();
            //$table->integer('id_conocimiento')->unsigned();

            $table->timestamps();

            $table->foreign('id_practica')->references('id')->on('practicas');
            //$table->foreign('id_conocimiento')->references('id')->on('eval_conocimientos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eval_con_emp_practicas');
    }
}
