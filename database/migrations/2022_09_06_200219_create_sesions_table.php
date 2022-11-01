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
            $table->string('objetivo'); //varchar en laravel
            $table->string('descripcion')->nullable();
            $table->date('fecha_finalizada')->nullable();
            $table->string('respuesta')->nullable();
            $table->string('barreras')->nullable();
            $table->string('facilitadores')->nullable();
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('etapa_id');

            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete("cascade");
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete("cascade");
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
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
