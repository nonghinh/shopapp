<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('cover_image');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->text('description_place')->nullable();
            $table->string('location')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('opening_time')->nullable();
            $table->string('closing_time')->nullable();
            $table->string('last_order_time')->nullable();
            $table->integer('min_price')->nullable();
            $table->integer('max_price')->nullable();
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
        Schema::drop('restaurants');
    }
}
