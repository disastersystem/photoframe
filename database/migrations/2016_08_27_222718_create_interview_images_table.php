<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('interview_id')->unsigned();
            $table->foreign('interview_id')->references('id')->on('interviews')->onDelete('cascade');

            $table->string('filename');
            $table->string('filepath');
            $table->string('thumbnail_filepath');
            $table->string('caption', 1000);

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
        Schema::drop('interview_images');
    }
}
