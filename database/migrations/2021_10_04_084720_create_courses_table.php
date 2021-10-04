<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('descripcion');
            $table->string('imaginUrl');
            $table->string('route');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->foreign('module_id')
                    ->references('id')
                    ->on('module')
                    ->onDelete('set null');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
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
        Schema::dropIfExists('course');
    }
}
