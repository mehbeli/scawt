<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVictimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('victims', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('scam_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('victim')->default(false);
            $table->boolean('reported')->defalt(false);
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
        Schema::drop('victims');
    }
}
