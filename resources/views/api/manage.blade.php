@extends('layouts.app')

@section('content')

    @include('includes.btn-home')

    <div class="container">
        <div class="text-center mb-5">
            <i class="fa fa-puzzle-piece fa-5x mb-5"></i>
            <h1>Manage your {{ env('APP_NAME') }} API</h1>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <passport-clients></passport-clients>
            </div>
            <div class="col-12 mb-3">
                <passport-authorized-clients></passport-authorized-clients>
            </div>
            <div class="col-12 mb-3">
                <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
    </div>


@endsection