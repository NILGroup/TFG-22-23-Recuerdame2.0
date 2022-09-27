<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recuerdos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('localizacion');
            //id_etapa
            $table->unsignedBigInteger('etapa_id');
            //id_categoria
            $table->unsignedBigInteger('categoria_id');
            //id_emocion
            $table->unsignedBigInteger('emocion_id');
            //id_estado
            $table->unsignedBigInteger('estado_id');
            //id_etiqueta
            $table->unsignedBigInteger('etiqueta_id');

            $table->integer('puntuacion');

            //id_paciente
            $table->unsignedBigInteger('paciente_id');

            $table->timestamps();

            $table->foreign('etapa_id')->references('id')->on('etapas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('emocion_id')->references('id')->on('emocions');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas');
            $table->foreign('paciente_id')->references('id')->on('pacientes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recuerdos');
    }
};
