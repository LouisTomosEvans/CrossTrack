<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_searches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->double('lat');
            $table->double('lon');
            $table->string('url');
            $table->foreignId('user_id');
            $table->foreignId('website_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_searches');
    }
}
