<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionesSupervisorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones_supervisor', function (Blueprint $table) {
            $table->integer('id_practica')->unsigned(); //PK,FK
            $table->primary('id_practica');

            $table->integer('porcent_tarea_realizadas')->unsigned();
            $table->string('resultado_eval');
            $table->date('f_entrega_eval');
            $table->timestamps();

            $table->foreign('id_practica')->references('id_practica')
                    ->on('practicas')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluaciones_supervisor');
    }
}
