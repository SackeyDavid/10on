<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('start_point')->nullable();
            $table->string('destination')->nullable();
            $table->string('road_fare')->nullable();
            $table->string('carrier_imposed_charges')->nullable();
            $table->string('total_tax')->nullable()->nullable();
            $table->string('total_per_passenger')->nullable();
            $table->string('from_client')->nullable();
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
        Schema::dropIfExists('fares');
    }
}
