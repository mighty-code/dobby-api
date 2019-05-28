<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('from');
            $table->integer('station_id')->nullable();
            $table->integer('destination_id')->nullable();
            $table->integer('via_id')->nullable();
            $table->string('to');
            $table->string('via')->nullable();
            $table->integer('departure')->nullable();
            $table->string('departure_platform')->nullable();
            $table->integer('arrival')->nullable();
            $table->string('duration')->nullable();
            $table->integer('time_to_station')->nullable();
            $table->boolean('selected')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connections');
    }
}
