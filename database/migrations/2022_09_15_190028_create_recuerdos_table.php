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
            $table->date('fecha')->nullable();
            $table->longText('nombre');
            $table->longText('descripcion')->nullable();
            $table->longText('localizacion')->nullable();
            $table->integer('puntuacion');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('etapa_id');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('emocion_id')->nullable();
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->unsignedBigInteger('etiqueta_id')->nullable();
            $table->boolean('apto')->default(true);

            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete("cascade");
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete("cascade");
            $table->string('tipo_custom')->nullable();
            $table->foreign('emocion_id')->references('id')->on('emocions')->onDelete("cascade");
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete("cascade");
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas')->onDelete("cascade");
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete("cascade");
            $table->softDeletes();
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
