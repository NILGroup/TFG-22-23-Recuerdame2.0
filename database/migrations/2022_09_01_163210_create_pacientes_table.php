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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("apellidos");
            $table->date("fecha_nacimiento");
            $table->string("lugar_nacimiento");
            $table->string("nacionalidad");
            $table->string("ocupacion");
            $table->string("residencia_actual");
            $table->date("fecha_inscripcion")->nullable();
            $table->string("residencia_custom")->nullable();
            $table->integer("residencia_id");
            $table->integer("situacion_id");
            $table->integer("estudio_id");
            $table->integer("genero_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
};
