<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEventRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_restaurant', function(Blueprint $table){

            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('cate_id')->unsigned();
            $table->foreign('cate_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('restaurant_id')->unsigned();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('event_types')->onDelete('cascade');
            $table->text('info_event');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
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
        Schema::drop('event_restaurant');
    }
}
