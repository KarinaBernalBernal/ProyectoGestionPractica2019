<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaEvaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_evaluacion', function (Blueprint $table) {
            $table->integer('id_eval_supervisor')->unsigned();
            $table->integer('id_area')->unsigned();
            $table->integer('vigencia')->default(1);
            $table->timestamps();

            $table->foreign('id_eval_supervisor')->references('id_eval_supervisor')
                    ->on('evaluaciones_supervisor')->onDelete('cascade');
            $table->foreign('id_area')->references('id_area')
                    ->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_evaluacion');
    }
}
