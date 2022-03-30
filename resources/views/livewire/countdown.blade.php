@php /** @var \App\Models\TimetableEntry $timetableEntry */ @endphp
<div class="pt-5 text-white flex flex-col" wire:poll.visible.60s>
    <div class="flex justify-center items-center">
        <div class="text-center">
            <h1 class="text-[20rem]">{{ $countdown }}</h1>
        </div>
    </div>
    <div class="grid grid-cols-12 border border-white rounded-3xl p-1">
        <div
            class="col-span-5 flex flex-col justify-center items-center"
        >
            <x-icons.home class="w-10 h-10 mb-3" />
            <span class="text-4xl">{{ $timetableEntry->departure_from }}</span>
            <span
                class="text-2xl">{{ $timetableEntry->departure_at?->timezone('Europe/Zurich')->format('H:i') }}</span>
        </div>
        <div
            class="col-span-2 flex justify-center items-center flex-col py-4"
        >
            @if($timetableEntry->departure_platform)
                <div>
                    Platform {{ $timetableEntry->departure_platform }}
                </div>
            @endif
            <x-icons.arrow-right class="h-14 w-14"/>
            @if($timetableEntry->arrival_platform)
                <div v-if="$timetableEntry->arrival_platform">
                    Platform {{ $timetableEntry->arrival_platform }}
                </div
                >
            @endif
        </div>
        <div
            class="col-span-5 flex flex-col justify-center items-center"
        >
            <x-icons.marker class="w-10 h-10 mb-3" />
            <span class="text-4xl">{{ $timetableEntry->arrival_to }}</span>
            <span
                class="text-2xl">{{ $timetableEntry->arrival_at?->timezone('Europe/Zurich')->format('H:i') }}</span>
        </div>
    </div>
</div>
