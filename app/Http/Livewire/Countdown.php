<?php

namespace App\Http\Livewire;

use App\Models\Connection;
use App\Services\ConnectionService;
use Livewire\Component;

class Countdown extends Component
{
    public function render()
    {
        $connectionService = resolve(ConnectionService::class);
        $nextConnection = $connectionService->getNextConnection(auth()->user());
        $nextTimeTableEntry = $nextConnection->timetableEntries()->first();
ray($nextTimeTableEntry);
        return view('livewire.countdown', [
            'timetableEntry' => $nextTimeTableEntry,
            'countdown' => $this->getCountdown($nextConnection),
        ]);
    }

    protected function getCountdown(?Connection $nextConnection)
    {
        $countdown = $nextConnection?->leaveInMinutes();

        if ($countdown <= 0) {
            $countdown = 'now';
        } else if ($countdown > 60) {
            $countdown = '>60';
        }

        return $countdown;
    }
}
