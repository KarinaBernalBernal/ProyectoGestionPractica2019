<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFortalezasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortalezas', function (Blueprint $table) {
            $table->increments('id_fortaleza');
            $table->string('n_fortaleza');
            $table->string('dp_fortaleza');
            
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
        Schema::dropIfExists('fortalezas');
    }
}
