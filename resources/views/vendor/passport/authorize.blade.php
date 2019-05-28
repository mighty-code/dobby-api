@extends('layouts.app')

@section('content')
    <div class="row h-100">
        <div class="col-12 flex-center">
            <i class="fa fa-lock fs-5 mb-5"></i>
            <h1>Authorization Request</h1>
            <!-- Introduction -->
            <h4 class="mt-1 mb-5"><strong>{{ $client->name }}</strong> is requesting permission to access your account.</h4>

            <!-- Scope List -->
            @if (count($scopes) > 0)
                <div class="scopes">
                    <p><strong>This application will be able to:</strong></p>

                    <ul>
                        @foreach ($scopes as $scope)
                            <li>{{ $scope->description }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-6">
                    <!-- Authorize Button -->
                    <form method="post" action="/oauth/authorize">
                        {{ csrf_field() }}

                        <input type="hidden" name="state" value="{{ $request->state }}">
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <button type="submit" class="btn btn-success btn-approve">Authorize</button>
                    </form>

                </div>
                <div class="col-6">
                    <!-- Cancel Button -->
                    <form method="post" action="/oauth/authorize">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <input type="hidden" name="state" value="{{ $request->state }}">
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <button class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
@endsection