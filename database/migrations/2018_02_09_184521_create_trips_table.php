<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('departure_location');
            $table->string('arrival_location');
            $table->string('departure_time');
            $table->string('arrival_time');
            $table->string('departure_date');
            $table->string('arrival_date');
            $table->string('trip_duration');
            $table->string('via');
            $table->string('trip_fare');
            $table->string('from_client');
            $table->string('fare_id');
            $table->string('remaining_seats');
            $table->string('kilometers');
            $table->string('bus_id');
            $table->string('departure_station_id');
            $table->string('arrival_station_id');
            $table->string('tax_id');
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
        Schema::dropIfExists('trips');
    }
}
