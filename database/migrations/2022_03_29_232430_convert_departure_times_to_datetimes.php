<?php

use App\Models\TimetableEntry;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('timetable_entries', function (Blueprint $table) {
            $table->dateTime('departure_at')->nullable()->after('departure_at_utc');
            $table->dateTime('arrival_at')->nullable()->after('arrival_at_utc');
        });

        TimetableEntry::cursor()->each(function ($entry) {
            $entry->departure_at = Carbon::createFromTimestampUTC($entry->departure_at_utc);
            $entry->arrival_at = Carbon::createFromTimestampUTC($entry->arrival_at_utc);
            $entry->save();
        });

        Schema::table('timetable_entries', function (Blueprint $table) {
            $table->dropColumn('departure_at_utc');
            $table->dropColumn('arrival_at_utc');
        });
    }

};
