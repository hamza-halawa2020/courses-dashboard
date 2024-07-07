<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddPointFromExamLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_point_from_exam_lectures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('point_detail_id')->references('id')->on('point_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('testing_exam_lecture_id')->unique()->references('id')->on('testing_exam_lectures')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_point_from_exam_lectures');
    }
}
