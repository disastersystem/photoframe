<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');

            $table->string('title');

            $table->date('leaving')->nullable();
            $table->date('returning')->nullable();

            $table->text('program')->nullable();
            $table->text('other')->nullable();

            $table->tinyInteger('recruitment_type')->default(0);
            $table->tinyInteger('airplane_tickets_help')->default(0);

            $table->integer('double_price')->default(0);
            $table->integer('single_price')->default(0);
            $table->integer('discount')->default(0);

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
        Schema::drop('trips');
    }
}
