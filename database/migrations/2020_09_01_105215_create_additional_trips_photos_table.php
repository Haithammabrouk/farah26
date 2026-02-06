<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdditionalTripsPhotosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_trips_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('additional_trip_id')->unsigned();
            $table->string('photo');
            $table->timestamps();

            $table->foreign('additional_trip_id')->references('id')->on('additional_trips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('additional_trips_photos');
    }
}
