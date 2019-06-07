<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosSolicitadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_solicitados', function (Blueprint $table) {
            $table->increments('id_doc_solicitado');
            $table->date('f_solicitud');
            $table->boolean('carta_presentacion');
            $table->boolean('seguro_escolar');
            $table->date('f_desde');
            $table->date('f_hasta');
            $table->string('n_destinatario');
            $table->string('cargo');
            $table->string('departamento');
            $table->string('cuidad');
            $table->string('empresa');

            $table->integer('id_alumno')->unsigned();
            $table->timestamps();

            $table->foreign('id_alumno')->references('id_alumno')
                    ->on('alumnos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_solicitados');
    }
}
