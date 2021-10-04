<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('cardType');
            $table->foreign('topics_id')
                    ->references('id')
                    ->on('topics')
                    ->onDelete('set null');
            $table->timestamps();
            $table->foreign('videos_id')
                    ->references('id')
                    ->on('videos')
                    ->onDelete('set null')
                    ->nullable;
             $table->foreign('texts_id')
                    ->references('id')
                    ->on('texts')
                    ->onDelete('set null')
                    ->nullable;
             $table->foreign('lists_id')
                    ->references('id')
                    ->on('lists')
                    ->onDelete('set null')
                    ->nullable;
             $table->foreign('tests_id')
                    ->references('id')
                    ->on('tests')
                    ->onDelete('set null')
                    ->nullable;
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
        Schema::dropIfExists('cards');
    }
}
