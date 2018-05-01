<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_process', function (Blueprint $table) {
            $table->increments('id');
            $table->string('passenger_id')->nullable();
            $table->string('outbound')->nullable();
            $table->string('inbound')->nullable();
            $table->string('card_id')->nullable();
            $table->string('mobile_money_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('made_payment')->nullable();
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
        Schema::dropIfExists('booking_process');
    }
}
