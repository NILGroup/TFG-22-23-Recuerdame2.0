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
        Schema::create('persona_relacionada', function (Blueprint $table) {

            $table->id();
            $table->string("nombre");
            $table->string("apellidos");
            $table->string("telefono")->unique();
            $table->string("ocupacion");
            $table->string("email")->unique();
            $table->unsignedBigInteger("id_tipo_relacion");
            $table->timestamps();

            $table->foreign("id_tipo_relacion")->references("id")->on("tipo_relacion")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_relacionada');
    }
};
