<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

            $table->string('filename');
            $table->string('filepath', 500);
            $table->string('thumbnail_filepath', 500)->default('');
            // $table->string('caption', 1000)->default('');

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
        Schema::drop('group_images');
    }
}