<?php

namespace App\Http\Livewire;

use App\Events\UpdateNextConnection;
use App\Models\Connection;
use App\Models\User;
use Livewire\Component;
use MatanYadaev\EloquentSpatial\Objects\Point;

class CreateConnection extends Component
{
    public string $submitText = 'Save';

    public ?string $error = null;

    public bool $showVia = false;

    public $station = null;

    public $destination = null;

    public $via = null;

    public ?string $time_to_station = null;

    protected $listeners = ['stationSelected'];

    public bool $onboarding = false;

    public function mount($submitText = 'Save', $onboarding = false)
    {
        $this->submitText = $submitText;
        $this->onboarding = $onboarding;
    }

    public function render()
    {
        return view('livewire.create-connection');
    }

    public function toggleVia()
    {
        $this->showVia = !$this->showVia;
    }

    public function stationSelected($event)
    {
        $this->{$event['name']} = $event['station'];
    }

    public function create()
    {
        $this->validate([
            'station' => 'required',
            'destination' => 'required',
            'via' => 'nullable',
            'time_to_station' => 'nullable',
        ]);

        $connection = Connection::make([
            'station_id' => $this->station['stationId'],
            'from' => $this->station['name'],
            'from_location' => new Point($this->station['latitude'], $this->station['longitude']),

            'destination_id' => $this->destination['stationId'],
            'to' => $this->destination['name'],
            'to_location' => new Point($this->destination['latitude'], $this->destination['longitude']),

            'via_id' => $this->via['stationId'] ?? null,
            'time_to_station' => $this->time_to_station,
        ]);

        if ($this->onboarding) {
            $connection->selected = true;
        }

        /** @var User $user */
        $user = auth()->user();
        $user->connections()->save($connection);
        $user->first_login = false;
        $user->save();

        event(new UpdateNextConnection($connection->id));

        $this->error = null;

        $this->emit('connectionCreated');

        if($this->onboarding) {
            return $this->redirectRoute('home');
        } else {
            $this->reset();
        }
    }
}
