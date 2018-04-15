<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesFeesAndChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes_fees_and_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('for_fare');
            $table->string('tax-NTA')->nullable();
            $table->string('passenger_service_charge')->nullable();
            $table->string('passenger_facilities_charge')->nullable();
            $table->string('advance_passenger_information_fee')->nullable();
            $table->string('station_service_charge')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('taxes_fees_and_charges');
    }
}
