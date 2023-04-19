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
        Schema::create('informesesions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_finalizada');
            $table->longText("duracion");
            $table->longText('respuesta')->nullable();
            $table->longText('observaciones')->nullable();
            $table->longText('barreras')->nullable();
            $table->longText('facilitadores')->nullable();
            $table->longText("propuestas")->nullable();
            
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sesion_id');
            $table->unsignedBigInteger('participacion_id')->nullable();
            $table->unsignedBigInteger('complejidad_id')->nullable();

            $table->foreign('participacion_id')->references('id')->on('participacions')->onDelete("cascade");
            $table->foreign('complejidad_id')->references('id')->on('complejidads')->onDelete("cascade");
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete("cascade");
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('sesion_id')->references('id')->on('sesions')->onDelete("cascade");
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
        Schema::dropIfExists('informesesions');
    }
};
