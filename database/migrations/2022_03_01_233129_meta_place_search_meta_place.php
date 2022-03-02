<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MetaPlaceSearchMetaPlace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_place_meta_place_search', function (Blueprint $table) {
            $table->foreignId('meta_place_search_id')->constrained();
            $table->foreignId('meta_place_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_place_meta_place_search');
    }
}
