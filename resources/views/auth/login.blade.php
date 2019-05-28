@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center flex-column">

            <div class="col-sm-12 col-md-6 col-lg-4">

                <h1 class="text-center mb-3">{{ env('APP_NAME') }}</h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12">
                            <input
                                    id="email"
                                    type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Email"
                                    required
                                    autofocus
                            >

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <input
                                    id="password"
                                    type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    placeholder="Super secret password"
                                    name="password"
                                    required
                            >

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row d-none">
                        <div class="col-md-6 offset-md-4">
                            <div class="checkbox">
                                <label class="text-white">Remember me
                                    <input type="checkbox" checked
                                           name="remember">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-primary btn-block">
                                {{ __('Login') }}
                            </button>

                            <a class="btn btn-link text-white link-unstyled" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
