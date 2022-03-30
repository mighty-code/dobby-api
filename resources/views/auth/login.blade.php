@extends('layouts.app')

@section('content')
    <div class="container h-full mx-auto">
        <div class="flex h-full flex-col justify-center items-center">

            <div class="w-full md:w-1/2 lg:w-1/3">

                <h1 class="text-center mb-3 text-3xl text-white">{{ config('app.name') }}</h1>

                <form method="POST" action="{{ route('login') }}"
                      class="flex flex-col space-y-4">
                    @csrf

                    <div class="w-full flex flex-col space-y-2">
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
                            <div class="text-red-200 font-semibold px-4">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="w-full">
                        <input
                            id="password"
                            type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            placeholder="Super secret password"
                            name="password"
                            required
                        >

                        @if ($errors->has('password'))
                            <div class="text-red-200 font-semibold px-4">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="hidden">
                        <div class="checkbox">
                            <label class="text-white">Remember me
                                <input type="checkbox" checked
                                       name="remember">
                            </label>
                        </div>
                    </div>

                    <div class="w-full flex justify-center flex-col items-center space-y-4">
                        <button type="submit"
                                class="border-4 border-white rounded-full text-white text-xl py-2 px-14 block">
                            {{ __('Login') }}
                        </button>

                        <a class="btn btn-link text-white link-unstyled" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
