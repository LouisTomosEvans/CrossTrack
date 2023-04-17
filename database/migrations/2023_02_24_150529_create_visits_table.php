<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('timestamp');
            $table->string('visitor_id');
            $table->foreignId('company_leads_id')->constrained('websites')->nullable();
            $table->string('referrer');
            $table->string('url');
            $table->string('title');
            $table->string('ip_address');
            $table->string('session_duration');
            $table->string('query_string_params');
            $table->string('screen_size_width');
            $table->string('screen_size_height');
            $table->string('device_type');
            $table->string('operating_system');
            $table->string('browser_version');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
};
