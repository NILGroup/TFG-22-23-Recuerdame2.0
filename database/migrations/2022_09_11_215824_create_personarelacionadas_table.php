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
        Schema::create('personarelacionadas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("apellidos");
            $table->string("telefono")->nullable();
            $table->string("ocupacion");
            $table->string("email");
            $table->unsignedBigInteger("tiporelacion_id");
            $table->unsignedBigInteger("paciente_id");

            $table->foreign("tiporelacion_id")->references("id")->on("tiporelacions")->onDelete("cascade");
            $table->foreign("paciente_id")->references("id")->on("pacientes")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personarelacionadas');
    }
};
