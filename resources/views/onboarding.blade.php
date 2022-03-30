@extends('layouts.app')

@section('content')
    <div class="container h-full mx-auto">
        <div class="flex h-full flex-col items-center">
            <div class="w-full md:w-1/2 lg:w-1/3 text-white">
                <div class="flex flex-col space-y-2">
                <h1 class="text-xl">Hi {{ auth()->user()->name  }}, I'm {{ config('app.name') }}!</h1>
                <div>I'll let you know when you have to leave your place to catch the next connection.</div>
                </div>
                <div class="row mt-4" style="min-width: 300px">
                    <div class="col-12">
                        <livewire:create-connection onboarding submit-text="Continue" />
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
