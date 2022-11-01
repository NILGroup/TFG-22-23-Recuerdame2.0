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
        Schema::create('multimedia_recuerdo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('multimedia_id');
            $table->unsignedBigInteger('recuerdo_id');

            $table->foreign("multimedia_id")->references("id")->on("multimedias")->onDelete("cascade");
            $table->foreign("recuerdo_id")->references("id")->on("recuerdos")->onDelete("cascade");
            $table->unique(['multimedia_id', 'recuerdo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multimedia_recuerdo');
    }
};
