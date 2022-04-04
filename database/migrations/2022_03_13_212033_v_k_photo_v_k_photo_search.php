<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VKPhotoVKPhotoSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_k_photo_v_k_photo_search', function (Blueprint $table) {
            $table->foreignId('v_k_photo_search_id')->constrained();
            $table->foreignId('v_k_photo_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_k_photo_v_k_photo_search');
    }
}
