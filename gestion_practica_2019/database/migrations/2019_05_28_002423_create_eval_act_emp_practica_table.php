<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvalActEmpPracticaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_act_emp_practica', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valor_act_emp_practica');
            
            $table->integer('id_practica')->unsigned();
             //$table->integer('id_actitudinal')->unsigned();

            $table->timestamps();

            $table->foreign('id_practica')->references('id')->on('practicas');
            //$table->foreign('id_actitudinal')->references('id')->on('eval_actitudinales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eval_act_emp_practica');
    }
}
