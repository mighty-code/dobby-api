<div>
    <div class="relative w-full">
        <input
            placeholder="{{$placeholder}}"
            wire:model.debounce="search"
            wire:focus="searchStations"
            class="form-control"
            required
        />
        @if(count($results) > 0)
            <div class="absolute bg-white text-brand  mt-2 rounded w-full z-50" x-on:click.away="$wire.hideResults()">
                <ul class="flex flex-col space-y-1 w-full">
                    @foreach($results as $result)
                        <li class="flex items-center w-full">
                            <button
                                type="button"
                                wire:click="setStation({{$result['stationId']}})"
                                class="hover:bg-blue-300 p-2 flex  w-full"
                            >
                                {{ $result['name'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
