<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debilidades', function (Blueprint $table) {
            $table->increments('id_debilidad');
            $table->string('n_debilidad');
            $table->string('dp_debilidad');
            
            $table->integer('id_eval_supervisor')->unsigned();
            $table->timestamps();
            
            $table->foreign('id_eval_supervisor')->references('id_eval_supervisor')
                    ->on('evaluaciones_supervisor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debilidades');
    }
}
