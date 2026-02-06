<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDecksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->string('other_file');
            $table->timestamps();
        });

        Schema::create('deck_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('deck_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->longText('content');

            $table->unique(['deck_id', 'locale']);

            $table->foreign('deck_id')->references('id')->on('decks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deck_translations');
        Schema::drop('decks');
    }
}
