@extends('layouts.app')

@section('content')
    <div class="flex-center h-100">
        <div class="col-md-6">

            <form method="POST" action="{{ route('password.email') }}" class="h-100 flex-center">
                @csrf

                <div class="col-md-6 text-center">

                    <i class="fas fa-sync-alt fa-3x"></i>

                    <h1 class="m-5">Reset Password</h1>

                    <input id="email"
                           type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           placeholder="Email"
                    >

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif

                    <button type="submit" class="btn btn-primary btn-block mt-2">
                        {{ __('Send Password Reset Link') }}
                    </button>

                </div>

            </form>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

        </div>
    </div>
@endsection
