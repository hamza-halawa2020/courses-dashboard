<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_lectures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('answer');
            $table->foreignId('exam_lecture_id')->references('id')->on('exam_lectures')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('is_right')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_lectures');
    }
}
