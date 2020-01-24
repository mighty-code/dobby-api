<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetableEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetable_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('connection_id');

            $table->string('departure_from');
            $table->string('departure_at_utc');
            $table->integer('departure_delay');
            $table->string('departure_platform');

            $table->string('arrival_to');
            $table->string('arrival_at_utc');
            $table->integer('arrival_delay');
            $table->string('arrival_platform');

            $table->integer('duration_minutes');
            $table->json('route');

            $table->json('data');

            $table->timestamps();

            $table->foreign('connection_id')->references('id')->on('connections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetable_entries');
    }
}
