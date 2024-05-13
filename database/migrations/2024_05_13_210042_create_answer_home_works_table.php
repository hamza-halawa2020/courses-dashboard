<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerHomeWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_home_works', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('answer');
            $table->foreignId('question_home_work_id')->references('id')->on('question_home_works')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('answer_home_works');
    }
}
