@extends('layouts.app')

@section('content')

    <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
        <h1>Hi {{ auth()->user()->name  }}, I'm {{ env('APP_NAME') }}!</h1>
        <p>I'll let you know when you have to leave your place to catch the next connection.</p>
        <div class="row mt-4" style="min-width: 300px">
            <div class="col-12">
                <create-connection onboarding submit_text="Continue"></create-connection>
            </div>
        </div>
    </div>

@endsection