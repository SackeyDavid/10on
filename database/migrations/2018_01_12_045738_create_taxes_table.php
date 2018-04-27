<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tax_NTA')->nullable();
            $table->string('passenger_service_charge')->nullable();
            $table->string('passenger_facilities_charge')->nullable();
            $table->string('advance_passenger_info_fee')->nullable();
            $table->string('station_service_charge')->nullable();
            $table->string('total')->nullable();
            $table->string('from_client')->nullable();
            $table->string('for_trip')->nullable();
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
        Schema::dropIfExists('taxes');
    }
}
