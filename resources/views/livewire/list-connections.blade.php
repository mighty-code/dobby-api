@php /** @var \App\Models\Connection $connection */ @endphp
<div class="row">

    @foreach($connections as $connection)

        <div class="mb-3">
            <div class="border rounded-xl">
                <div
                    class="card-body d-flex justify-content-center align-items-between flex-column"
                >
                    <div class="flex items-center justify-between py-5 px-5 space-x-4 text-white text-xl">
                        <div class="col-md-1 flex-center">
                            <div class="h-6 w-6 cursor-pointer">
                                @if(!$connection->selected)
                                    <x-icons.trash wire:click="delete({{ $connection->id }})" class=""/>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 flex-center">
                            <h3 class="text-center">
                                {{ $connection->from }}
                                <small
                                >({{ $connection->time_to_station }}min)</small
                                >
                            </h3>
                        </div>
                        <div class="col-md-2 flex-center">
                            <x-icons.arrow-right class="h-4"/>
                            @if($connection->via)
                                <div>via {{ $connection->via }}</div>
                            @endif
                        </div>
                        <div class="col-md-4 flex-center">
                            <h3 class="text-center">{{ $connection->to }}</h3>
                        </div>

                        <div class="col-md-1 flex-center">
                            @if($connection->selected)
                                <x-icons.checkmark-circle class="h-6 w-6"/>
                            @else
                                <div class="h-6 w-6 cursor-pointer group"
                                     wire:click="makeDefault({{ $connection->id }})">
                                    <x-icons.checkmark class="h-6 w-6 group-hover:hidden block"/>
                                    <x-icons.checkmark-circle class="h-6 w-6 hidden group-hover:block"/>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
