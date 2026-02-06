<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdditionalTripsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_trips', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price');
            $table->decimal('SinglePrice');
            $table->string('img');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('additional_trip_translations', function(Blueprint $table)
        {
            $table->increments('trans_id');
            $table->integer('additional_trip_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->string('location');
            $table->text('details');

            $table->unique(['additional_trip_id', 'locale']);

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
        Schema::drop('additional_trip_translations');
        Schema::drop('additional_trips');
    }
}
