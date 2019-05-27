<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasAutoevalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas_autoeval', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_autoeval')->unsigned();
            $table->integer('id_area')->unsigned();

            $table->timestamps();
            $table->foreign('id_autoeval')->references('id')->on('autoevaluaciones');
            $table->foreign('id_area')->references('id')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas_autoeval');
    }
}
