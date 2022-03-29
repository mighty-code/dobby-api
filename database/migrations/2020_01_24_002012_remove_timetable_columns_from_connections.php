<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('connections', function (Blueprint $table) {
            $table->dropColumn('departure');
            $table->dropColumn('departure_platform');
            $table->dropColumn('duration');
            $table->dropColumn('arrival');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('connections', function (Blueprint $table) {
            $table->integer('departure')->nullable();
            $table->string('departure_platform')->nullable();
            $table->integer('arrival')->nullable();
            $table->string('duration')->nullable();
        });
    }
};
