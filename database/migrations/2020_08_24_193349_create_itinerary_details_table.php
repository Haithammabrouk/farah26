<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItineraryDetailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('itinerary_id')->unsigned();
            $table->timestamps();
            $table->foreign('itinerary_id')->references('id')->on('itineraries')->onDelete('cascade');
        });

        Schema::create('itinerary_detail_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('itinerary_detail_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('text');

            $table->unique(['itinerary_detail_id', 'locale']);

            $table->foreign('itinerary_detail_id')->references('id')->on('itinerary_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('itinerary_detail_translations');
        Schema::drop('itinerary_details');
    }
}
