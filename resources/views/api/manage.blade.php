@extends('layouts.app')

@section('content')

    <div class="container h-full mx-auto">

        <div class="flex h-full flex-col items-center">
            <div class="flex justify-center">
                <x-goto-home/>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/2 mt-10 flex flex-col space-y-8">
                <div class="flex justify-center py-4">
                    <x-icons.puzzle class="text-white h-20"/>
                </div>

                <h1 class="text-center text-white text-3xl">Manage your {{ config('app.name') }} API</h1>

                <livewire:sanctum-tokens/>
            </div>
        </div>
    </div>


@endsection
