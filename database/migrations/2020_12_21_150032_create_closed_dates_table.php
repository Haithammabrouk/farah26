<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClosedDatesTable extends Migration
{

    public function up()
    {
        Schema::create('closed_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
        });
    }

    public function down()
    {
        Schema::drop('closed_dates');
    }
}
