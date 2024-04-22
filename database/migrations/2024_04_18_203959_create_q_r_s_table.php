<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQRSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_r_s', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('image');
            $table->bigInteger('q_rvalue_id')->unsigned();
            $table->foreign('q_rvalue_id')->references('id')->on('q_rvalues');
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
        Schema::dropIfExists('q_r_s');
    }
}
