<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_chapters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('answer');
            $table->foreignId('total_exam_id')->references('id')->on('total_exams')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('answer_chapters');
    }
}
