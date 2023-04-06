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
        Schema::create('multimedias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('fichero');
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('personarelacionada_id')->nullable();
            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('paciente_id')->references("id")->on("pacientes")->onDelete("cascade");
            $table->foreign('personarelacionada_id')->references("id")->on("personarelacionadas")->onDelete("cascade");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multimedias');
    }
};
