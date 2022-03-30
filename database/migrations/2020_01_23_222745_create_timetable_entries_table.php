<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
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
            $table->integer('departure_at_utc');
            $table->integer('departure_delay');
            $table->string('departure_platform')->nullable();

            $table->string('arrival_to');
            $table->integer('arrival_at_utc');
            $table->integer('arrival_delay');
            $table->string('arrival_platform')->nullable();

            $table->integer('duration_minutes');
            $table->json('route');

            $table->json('data');

            $table->timestamps();

            $table->foreign('connection_id')->references('id')->on('connections')->onDelete('cascade');
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
};
