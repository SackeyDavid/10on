<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_client');
            $table->string('fuel')->default('no');
            $table->string('television')->default('no');
            $table->string('wifi')->default('no');
            $table->string('ac')->default('no');
            $table->string('wheel_lift')->default('no');
            $table->string('articulation')->default('no');
            $table->string('decker')->default('no');
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
        Schema::dropIfExists('special_features');
    }
}
