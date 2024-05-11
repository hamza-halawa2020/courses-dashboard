<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrAddedBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr_added_balances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('balance_details_id')->references('id')->on('balance_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('qr_id')->unique()->references('id')->on('q_r_s')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qr_added_balances');
    }
}
