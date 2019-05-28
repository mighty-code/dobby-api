@extends('layouts.app')

@section('content')
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="row mt-4" style="min-width: 300px">
            <div class="col-12">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <input id="name" type="text"
                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                               value="{{ old('name') }}" required autofocus
                               placeholder="Name">

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">

                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required
                               placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" required
                               placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required
                               placeholder="Confirm Password">

                    </div>

                    <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                </form>
            </div>
        </div>
@endsection
