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
        Schema::create('actividads', function (Blueprint $table) {
            $table->id();
            $table->date("start");
            $table->string("title");
            $table->string("description");
            $table->unsignedBigInteger("paciente_id");
            $table->string("color");
            $table->timestamps();

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
        Schema::dropIfExists('actividads');
    }
};
