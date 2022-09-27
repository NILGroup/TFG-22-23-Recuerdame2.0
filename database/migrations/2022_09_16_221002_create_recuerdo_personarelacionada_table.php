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
        Schema::create('personarelacionada_recuerdo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("recuerdo_id");
            $table->unsignedBigInteger("personarelacionada_id");
            $table->timestamps();

            $table->foreign("recuerdo_id")->references("id")->on("recuerdos");
            $table->foreign("personarelacionada_id")->references("id")->on("personarelacionadas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personarelacionada_recuerdo');
    }
};
