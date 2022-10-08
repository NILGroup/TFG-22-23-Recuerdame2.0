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
            $table->char("genero");
            $table->string("lugar_nacimiento");
            $table->string("nacionalidad");
            $table->date("fecha_nacimiento");
            $table->string("tipo_residencia");
            $table->string("residencia_actual");
            $table->integer("cuidador_id")->nullable();
            $table->timestamps();
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
