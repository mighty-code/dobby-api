<?php

namespace App\Http\Livewire;

use App\Events\UpdateNextConnection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListConnections extends Component
{
    protected $listeners = ['connectionCreated' => '$refresh'];

    public function render()
    {
        $connections = auth()->user()->connections;

        return view('livewire.list-connections', ['connections' => $connections]);
    }

    public function delete($connectionId)
    {
        $connection = auth()->user()->connections()->find($connectionId);
        if (! $connection->selected) {
            $connection->delete();
        }
    }

    public function makeDefault($connectionId)
    {
        DB::transaction(function () use ($connectionId) {
            $connection = auth()->user()->connections()->find($connectionId);
            $connection->update(['selected' => true]);
            auth()->user()->connections()->where('id', '!=', $connectionId)->update(['selected' => false]);

            event(new UpdateNextConnection($connection->id));
        });
    }
}
