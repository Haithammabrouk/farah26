<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTripCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo');
            $table->string('map');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('trip_category_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('trip_category_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->string('duration');
            $table->text('rate_plan');
            $table->text('desc');

            $table->unique(['trip_category_id', 'locale']);

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
        Schema::drop('trip_category_translations');
        Schema::drop('trip_categories');
    }
}
