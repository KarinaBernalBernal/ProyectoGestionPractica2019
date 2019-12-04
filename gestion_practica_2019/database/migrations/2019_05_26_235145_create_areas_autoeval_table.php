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
            $table->integer('id_autoeval')->unsigned();
            $table->integer('id_area')->unsigned()->nullable();
            $table->string('eleccion');
            $table->timestamps();
            
            $table->foreign('id_autoeval')->references('id_autoeval')
                    ->on('autoevaluaciones')->onDelete('cascade');
            $table->foreign('id_area')->references('id_area')
                    ->on('areas')->onDelete('set null');
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
