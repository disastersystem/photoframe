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

            $table->string('filename')->default('');
            $table->string('filepath')->default('');
            $table->string('thumbnail_filepath')->default('');
            
            $table->integer('width')->unsigned()->default(0);
            $table->integer('height')->unsigned()->default(0);

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