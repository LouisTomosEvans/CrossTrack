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
        Schema::create('lead_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_lead_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('company_lead_id')
                    ->references('id')
                    ->on('company_leads')
                    ->onDelete('cascade');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_user');
    }
};
