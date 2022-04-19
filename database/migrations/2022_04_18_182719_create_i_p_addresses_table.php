<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIPAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_p_addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id');
            $table->string('status');
            $table->string('country');
            $table->string('countryCode');
            $table->string('region');
            $table->string('regionName');
            $table->string('city');
            $table->string('zip');
            $table->double('lat');
            $table->double('lon');
            $table->string('isp');
            $table->string('org');
            $table->boolean('mobile');
            $table->boolean('proxy');
            $table->boolean('hosting');
            $table->string('query');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_p_addresses');
    }
}
