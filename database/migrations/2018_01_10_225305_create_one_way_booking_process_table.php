<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOneWayBookingProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('one_way_booking_process', function (Blueprint $table) {
            $table->increments('id');
            $table->string('passenger_id')->nullable();
            $table->string('trip_id')->nullable();
            $table->string('card_id')->nullable();
            $table->string('mobile_money_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('made_payment')->nullable();
            $table->string('checked_in')->nullable();
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
        Schema::dropIfExists('one_way_booking_process');
    }
}
