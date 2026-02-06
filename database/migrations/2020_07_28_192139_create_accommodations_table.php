<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reservation_id')->unsigned();
            $table->tinyInteger('type')->unsigned()->default(1)->comment('1 => cabin, 2 => suite');
            $table->integer('accommodation_num')->unsigned();
            $table->string('guest_name')->nullable();
            $table->tinyInteger('adults_count')->unsigned()->default(1);
            $table->tinyInteger('children_count')->unsigned()->default(0);
            $table->tinyInteger('child1_age')->unsigned()->nullable()->comment('1 => free, 2 => 50%');
            $table->tinyInteger('child2_age')->unsigned()->nullable()->comment('1 => free, 2 => 50%');
            $table->decimal('cabin_price')->comment('double');
            $table->decimal('suite_price')->comment('double');
            $table->decimal('single_cabin_price')->comment('single');
            $table->decimal('single_suite_price')->comment('single');
            $table->decimal('total_price');
            $table->tinyInteger('status')->nullable()->comment('null => pending, 0 => failed, 1 => success');
            $table->timestamps();
            
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodations');
    }
}
