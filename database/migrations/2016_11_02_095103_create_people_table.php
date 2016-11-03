<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('first_name_id')->unsigned()->nullable();
            $table->foreign('first_name_id')->references('id')->on('names');
            $table->integer('second_name_id')->unsigned()->nullable();
            $table->foreign('second_name_id')->references('id')->on('names');
            $table->integer('third_name_id')->unsigned()->nullable();
            $table->foreign('third_name_id')->references('id')->on('names');
            $table->integer('last_name_id')->unsigned()->nullable();
            $table->foreign('last_name_id')->references('id')->on('names');
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_death')->nullable();
            $table->string('gender')->nullable();
            $table->integer('place_of_birth_id')->unsigned()->nullable();
            $table->foreign('place_of_birth_id')->references('id')->on('places');
            $table->integer('place_of_death_id')->unsigned()->nullable();
            $table->foreign('place_of_death_id')->references('id')->on('places');
            $table->integer('father_id')->unsigned()->nullable();
            $table->foreign('father_id')->references('id')->on('people');
            $table->integer('mother_id')->unsigned()->nullable();
            $table->foreign('mother_id')->references('id')->on('people');
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
        Schema::dropIfExists('people');
    }
}
