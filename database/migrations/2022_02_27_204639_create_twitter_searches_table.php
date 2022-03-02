<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwitterSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_searches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->double('lat');
            $table->double('lon');
            $table->double('radius');
            $table->string('keywords')->nullable();
            $table->boolean('question')->nullable()->default(False);
            $table->foreignId('twitter_media_id')->nullable();
            $table->integer('min_likes')->nullable();
            $table->integer('min_retweets')->nullable();
            $table->string('url');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('twitter_searches');
    }
}
