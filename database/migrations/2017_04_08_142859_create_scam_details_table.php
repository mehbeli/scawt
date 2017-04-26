<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scam_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('scam_id')->unsigned();
            $table->string('scammer_name');
            $table->longText('modus_operandi_scam_details');
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
        Schema::drop('scam_details');
    }
}
