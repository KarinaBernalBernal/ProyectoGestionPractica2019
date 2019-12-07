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
            $table->integer('id_eval_supervisor')->unsigned();
            $table->integer('id_actitudinal')->unsigned();
            $table->integer('vigencia')->default(1);
            $table->string('valor_act_emp_practica');
            $table->timestamps();

            $table->foreign('id_eval_supervisor')->references('id_eval_supervisor')
                    ->on('evaluaciones_supervisor')->onDelete('cascade');
            $table->foreign('id_actitudinal')->references('id_actitudinal')
                    ->on('eval_actitudinales')->onDelete('cascade');
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
