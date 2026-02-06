<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalleriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(1)->comment('0 => Inactive, 1 => Active');
            $table->timestamps();
        });

        Schema::create('gallery_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('gallery_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');

            $table->unique(['gallery_id', 'locale']);

            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gallery_translations');
        Schema::drop('galleries');
    }
}
