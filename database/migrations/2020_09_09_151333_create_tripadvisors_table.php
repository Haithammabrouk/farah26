<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTripadvisorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tripadvisors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('tripadvisor_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('tripadvisor_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->text('title');
            $table->longText('text');

            $table->unique(['tripadvisor_id', 'locale']);

            $table->foreign('tripadvisor_id')
                ->references('id')
                ->on('tripadvisors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tripadvisor_translations');
        Schema::drop('tripadvisors');
    }
}
