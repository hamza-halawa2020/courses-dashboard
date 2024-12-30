<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvertPointToBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convert_point_to_balances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('balance_detail_id')->references('id')->on('balance_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('point_detail_id')->references('id')->on('point_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convert_point_to_balances');
    }
}
