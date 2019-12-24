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
            $table->integer('id_eval_supervisor')->unsigned();
            $table->integer('id_conocimiento')->unsigned();
            $table->string('valor_con_emp_practica');
            $table->timestamps();

            $table->foreign('id_eval_supervisor')->references('id_eval_supervisor')
                    ->on('evaluaciones_supervisor')->onDelete('cascade');
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
        Schema::dropIfExists('eval_con_emp_practicas');
    }
}
