<?php

namespace App\Http\Livewire;

use App\Models\Connection;
use App\Services\ViadiClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SearchStationInput extends Component
{
    public string $placeholder;

    public string $search = '';

    public array $results = [];

    public $name;

    public function mount($name, $placeholder = 'Search station', $station = null)
    {
        if ($station) {
            $this->search = $station->name;
        }

        $this->placeholder = $placeholder;
        $this->name = $name;
    }

    public function updatedSearch()
    {
        $this->searchStations();
    }

    public function setStation($stationId)
    {
        if (! Cache::has('search-station-input-'.$this->search)) {
            $this->searchStations();

            return;
        }

        /** @var Collection<Connection> $connections */
        $connections = Cache::get('search-station-input-'.$this->search);
        $station = $connections->where('stationId', $stationId)->first();

        $this->search = $station['name'];
        $this->results = [];
        $this->emitUp('stationSelected', ['name' => $this->name, 'station' => $station]);
    }

    public function searchStations(): void
    {
        $this->results = $this->getResults();
    }

    public function hideResults(): void
    {
        $this->results = [];
    }

    public function render()
    {
        return view('livewire.search-station-input');
    }

    private function getResults()
    {
        if ($this->search === '') {
            return [];
        }

        if (Cache::has('search-station-input-'.$this->search)) {
            $connections = Cache::get('search-station-input-'.$this->search);
        } else {
            ray()->showHttpClientRequests();
            $connections = collect(resolve(ViadiClient::class)->searchStation($this->search));
            Cache::set('search-station-input-'.$this->search, $connections, now()->addMinutes(5));
        }

        ray($connections);

        return $connections->toArray();
    }
}
