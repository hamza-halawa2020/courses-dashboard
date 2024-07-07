<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestingExamLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testing_exam_lectures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('answer_lecture_id')->references('id')->on('answer_lectures')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('is_right');
            $table->unique(['user_id', 'answer_lecture_id', 'is_right']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testing_exam_lectures');
    }
}
