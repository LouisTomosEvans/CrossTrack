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
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('active')->default(true);
            $table->integer('team_id')->unsigned();
            //  tracking specific fields
            $table->string('tracking_code');
            $table->boolean('tracking_status')->default(false);
            // domain
            $table->string('domain');
            // favicon image path
            $table->string('favicon');

            $table->timestamps();

            $table->foreign('team_id')
            ->references('id')
            ->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('websites');
    }
};
