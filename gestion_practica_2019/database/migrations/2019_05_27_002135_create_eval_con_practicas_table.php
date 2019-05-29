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
            $table->integer('id_practica')->unsigned();
            $table->integer('id_conocimiento')->unsigned();

            $table->timestamps();
            $table->foreign('id_practica')->references('id_practica')
                    ->on('practicas')->onDelete('cascade');
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
