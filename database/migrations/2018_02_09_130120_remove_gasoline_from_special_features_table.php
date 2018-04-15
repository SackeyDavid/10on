<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveGasolineFromSpecialFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('special_features', function (Blueprint $table) {
            $table->dropColumn(['gasoline', 'electricity']);
            $table->renameColumn('double_decker', 'decker');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('special_features', function (Blueprint $table) {
            //
        });
    }
}
