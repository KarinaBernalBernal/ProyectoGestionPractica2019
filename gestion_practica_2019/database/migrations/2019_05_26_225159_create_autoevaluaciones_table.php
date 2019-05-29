<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoevaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autoevaluaciones', function (Blueprint $table) {
            $table->integer('id_practica')->unsigned(); //PK,FK
            $table->primary('id_practica');

            $table->date('f_entrega');
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
        Schema::dropIfExists('autoevaluaciones');
    }
}
