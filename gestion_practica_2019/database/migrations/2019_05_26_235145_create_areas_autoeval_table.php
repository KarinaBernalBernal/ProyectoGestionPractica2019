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
            $table->integer('id_practica')->unsigned();
            $table->integer('id_area')->unsigned();
            $table->timestamps();
            
            $table->foreign('id_practica')->references('id_practica')
                    ->on('practicas')->onDelete('cascade');
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
        Schema::dropIfExists('areas_autoeval');
    }
}
