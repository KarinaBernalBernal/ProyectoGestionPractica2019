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
            
            $table->integer('id_practica')->unsigned();
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
        Schema::dropIfExists('fortalezas');
    }
}
