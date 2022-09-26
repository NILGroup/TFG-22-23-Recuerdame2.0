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
        Schema::create('persona_relacionadas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("apellidos");
            $table->string("telefono");
            $table->string("ocupacion");
            $table->string("email");
            $table->unsignedBigInteger("tipo_relacion_id");
            $table->timestamps();

            $table->foreign("tipo_relacion_id")->references("id")->on("tipo_relacions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_relacionadas');
    }
};
