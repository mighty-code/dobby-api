<div>
    <form wire:submit.prevent="create" class="flex flex-col space-y-4">
        <div class="grid grid-cols-12">
            <div class="col-span-5">
                <livewire:search-station-input placeholder="From" name="station" wire:model="$stationName"/>
            </div>
            <div class="col-span-2">
                <div
                    class="p-2 cursor-pointer flex justify-center items-center flex-col"
                    wire:click="toggleVia"
                >
                    <x-icons.arrow-right class="h-8 w-8 text-white"/>
                </div>
            </div>
            <div class="col-span-5">
                <livewire:search-station-input placeholder="To" name="destination" wire:model="$destinationName"/>
            </div>
        </div>

        @if($showVia)
            <livewire:search-station-input placeholder="via" name="via" wire:model="$viaName"/>
        @endif

        <div class="form-group">
            <input
                wire:model="time_to_station"
                placeholder="Time to station (Minutes)"
                class="form-control"
                required
            />
        </div>

        <div class="w-full flex justify-center flex-col items-center space-y-4">
            <button type="submit"
                    class="border-4 border-white rounded-full text-white text-xl py-2 px-14 block disabled:text-gray-400 disabled:border-gray-400"
                    @if(!$station || !$destination || !$time_to_station)disabled @endif
            >
                {{ $submitText }}
            </button>
        </div>

        @if($error)
            <div class="alert alert-danger mt-2">
                {{ $error }}
            </div>
        @endif
    </form>
</div>
