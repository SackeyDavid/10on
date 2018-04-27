<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileMoneyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_money_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('network')->nullable();
            $table->string('from_user')->nullable();
            $table->string('from_passenger')->nullable();
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
        Schema::dropIfExists('mobile_money_details');
    }
}
