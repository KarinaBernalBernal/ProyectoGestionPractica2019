<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePracticasCharlas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('practicas', function (Blueprint $table) {
            $table->integer('id_charla')->unsigned()->nullable();
            $table->foreign('id_charla')->references('id_charla')
                    ->on('charlas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('practicas', function (Blueprint $table) {
            $table->dropColumn('id_charla');
        });
    }
}
