<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateScamDetailsAddValueLossAndCurrency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scam_details', function (Blueprint $table) {
            $table->integer('currency')->unsigned()->nullable();
            $table->float('value_loss')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scam_details', function (Blueprint $table) {
            $table->dropColumn('currency');
            $table->dropColumn('value_loss');
        });
    }
}
