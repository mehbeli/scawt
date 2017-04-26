<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateScamsTableChangeColumnProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scams', function (Blueprint $table) {
                $table->dropColumn('location');
                $table->dropColumn('external');
        });

        Schema::table('scams', function (Blueprint $table) {
                $table->string('location')->nullable();
                $table->boolean('external')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scams', function (Blueprint $table) {
                $table->dropColumn('location');
                $table->dropColumn('external');
        });

        Schema::table('scams', function (Blueprint $table) {
                $table->string('location');
                $table->boolean('external');
        });
    }
}
