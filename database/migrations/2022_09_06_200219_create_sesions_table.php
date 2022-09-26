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
        Schema::create('sesions', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            //id_etapa int(11)
            $table->unsignedBigInteger('etapa_id');
            
            $table->string('objetivo'); //varchar en laravel
            $table->string('descripcion');
            $table->string('barreras');
            $table->string('facilitadores');
            $table->date('fecha_finalizada');
            //id_paciente
            $table->unsignedBigInteger('paciente_id');
            //id_usuario
            $table->unsignedBigInteger('usuario_id');
            $table->string('respuesta');
            $table->timestamps();


            $table->foreign('etapa_id')->references('id')->on('etapas');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesions');
    }
};
