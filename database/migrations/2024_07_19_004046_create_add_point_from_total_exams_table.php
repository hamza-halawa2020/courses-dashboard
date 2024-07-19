<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddPointFromTotalExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_point_from_total_exams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('point_detail_id')->references('id')->on('point_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('testing_total_exam_id')->unique()->references('id')->on('testing_total_exams')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_point_from_total_exams');
    }
}
