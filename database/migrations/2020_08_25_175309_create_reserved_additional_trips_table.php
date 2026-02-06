<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservedAdditionalTripsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserved_additional_trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reservation_id')->unsigned();
            $table->integer('additional_trip_id')->unsigned();
            $table->decimal('price');
           $table->decimal('SinglePrice');

            $table->tinyInteger('adults_count')->unsigned()->default(1);
            $table->tinyInteger('child1_count')->unsigned()->default(0)->comment('50%');
            $table->tinyInteger('child2_count')->unsigned()->default(0)->comment('free');
            $table->decimal('total_price');
            $table->tinyInteger('status')->nullable()->comment('null => pending, 0 => failed, 1 => success');
            $table->timestamps();

            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
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
        Schema::drop('reserved_additional_trips');
    }
}
