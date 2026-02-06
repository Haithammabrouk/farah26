<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacilitiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img');
            $table->timestamps();
        });

        Schema::create('facility_translations', function(Blueprint $table)
        {
            $table->increments('trans_id');
            $table->integer('facility_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->text('details');

            $table->unique(['facility_id', 'locale']);

            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('facility_translations');
        Schema::drop('facilities');
    }
}
