<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('lat');
            $table->double('lon');
            $table->bigInteger('external_id');
            $table->string('external_id_source')->nullable();
            $table->string('address')->nullable();
            $table->integer('minimum_age')->nullable();
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
        Schema::dropIfExists('meta_places');
    }
}
