<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuarioQueReta');
            $table->unsignedBigInteger('usuarioRetado');
            $table->integer('puntosApostados');
            $table->string('temario');
            $table->string('statusReto');
            $table->string('arrayRespuestasRetador')->nullable();
            $table->string('arrayRepuestasRetado')->nullable();
            $table->string('arrayPreguntas')->nullable();

            //NO NO            
            //$table->unsignedBigInteger('topic_id')->nullable();
            //$table->foreign('topic_id');
            //NO NO

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
        Schema::dropIfExists('reto');
    }
}
