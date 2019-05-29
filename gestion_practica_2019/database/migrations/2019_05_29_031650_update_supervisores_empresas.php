<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSupervisoresEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supervisores', function (Blueprint $table) {
            $table->unsignedInteger('id_empresa');
            $table->foreign('id_empresa')->references('id_empresa')
                    ->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supervisores', function (Blueprint $table) {
            //
        });
    }
}
