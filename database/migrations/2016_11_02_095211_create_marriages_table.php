<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarriagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marriages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('spouse_a_id')->unsigned();
            $table->foreign('spouse_a_id')->references('id')->on('people');
            $table->integer('spouse_b_id')->unsigned()->nullable();
            $table->foreign('spouse_b_id')->references('id')->on('people');
            $table->date('date_of_marriage')->nullable();
            $table->integer('place_of_marriage')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marriages');
    }
}
