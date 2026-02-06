<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTripsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_category_id')->unsigned();
            $table->date('check_in');
            $table->date('check_out');
            $table->tinyInteger('cabin_count')->unsigned();
            $table->tinyInteger('suite_count')->unsigned();
            $table->tinyInteger('cabin_available')->unsigned();
            $table->tinyInteger('suite_available')->unsigned();
            $table->decimal('cabin_price')->comment('double');
            $table->decimal('suite_price')->comment('double');
            $table->decimal('single_cabin_price')->comment('single');
            $table->decimal('single_suite_price')->comment('single');
            $table->tinyInteger('is_home')->default(0)->comment('0 => not in Home, 1 => in Home');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trip_category_id')->references('id')->on('trip_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trips');
    }
}
