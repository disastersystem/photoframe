<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trip_id')->unsigned();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');

            $table->string('filename');
            $table->string('filepath', 500);
            $table->string('thumbnail_filepath', 500)->default('');
            $table->string('caption', 1000)->default('');

            $table->integer('width')->unsigned();
            $table->integer('height')->unsigned();
            $table->integer('ratio')->unsigned();

            $table->timestamps();

            // $table->primary(['trip_id', 'image_id']);

            // $table->foreign('image_id')
            //       ->references('id')->on('images')
            //       # CASCADE: Delete or update the row from the parent table,
            //       # and automatically delete or update the matching rows in the child table.
            //       ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trip_images');
    }
}
