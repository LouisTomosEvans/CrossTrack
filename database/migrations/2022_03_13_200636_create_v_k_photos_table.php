<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVKPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_k_photos', function (Blueprint $table) {
            $table->id();
            $table->longText('text')->nullable();
            $table->double('lat');
            $table->double('lon');
            $table->bigInteger('photo_id');
            $table->bigInteger('date');
            $table->string('preview_URL')->nullable();
            $table->bigInteger('album_id')->nullable();
            $table->bigInteger('owner_id')->nullable();
            $table->bigInteger('post_id')->nullable();
            $table->boolean('has_tags')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('v_k_photos');
    }
}
