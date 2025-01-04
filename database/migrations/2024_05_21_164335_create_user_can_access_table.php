<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCanAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_can_access', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lecture_id')->nullable()->references('id')->on('lectures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('chapter_id')->nullable()->references('id')->on('chapters')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('watched')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_can_access');
    }
}
