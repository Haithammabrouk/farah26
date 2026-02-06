<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUniquesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uniques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('unique_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('unique_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->text('title');
            $table->longText('text');

            $table->unique(['unique_id', 'locale']);

            $table->foreign('unique_id')
                ->references('id')
                ->on('uniques')
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
        Schema::drop('unique_translations');
        Schema::drop('uniques');
    }
}
