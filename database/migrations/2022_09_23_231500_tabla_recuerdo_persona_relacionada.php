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
        Schema::create('recuerdo_persona_relacionada', function (Blueprint $table) {
            /*
            
                FALTA INDICAR QUE ID_RECUERDO REFERENCIA A ID DE LA TABLA RECUERDO AUN NO CREADA

            */
            $table->integer("id_recuerdo");
            $table->unsignedBigInteger("id_persona_relacionada");
            $table->timestamps();

            $table->foreign("id_persona_relacionada")->references("id")->on("persona_relacionada")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recuerdo_persona_relacionada');
    }
};
