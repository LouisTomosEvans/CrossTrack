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
        Schema::create('lead_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_leads_id');
            $table->float('score')->default(0);
            $table->timestamps();

            $table->foreign('company_leads_id')->references('id')->on('company_leads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_scores');
    }
};
