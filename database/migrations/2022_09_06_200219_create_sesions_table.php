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
            $table->string('titulo');
            $table->dateTime('fecha');
            $table->string('objetivo'); //varchar en laravel
            $table->string('descripcion')->nullable();
            $table->timestamp('fecha_finalizada')->nullable();
            $table->string('respuesta')->nullable();
            $table->string('barreras')->nullable();
            $table->string('acciones')->nullable();
            $table->string('facilitadores')->nullable();
            $table->string('observaciones')->nullable();
            $table->string("duracion")->nullable();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('etapa_id');
            $table->unsignedBigInteger('participacion_id')->nullable();;
            $table->unsignedBigInteger('complejidad_id')->nullable();;
            $table->boolean("finalizada")->default(false);

            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete("cascade");
            $table->foreign('participacion_id')->references('id')->on('participacions')->onDelete("cascade");
            $table->foreign('complejidad_id')->references('id')->on('complejidads')->onDelete("cascade");
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete("cascade");
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
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
        Schema::dropIfExists('sesions');
    }
};
