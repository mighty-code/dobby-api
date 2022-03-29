@extends('layouts.app')

@section('content')
    <div class="container h-full mx-auto">
        <div class="flex h-full flex-col justify-center items-center">
            <div class="w-full md:w-1/2 lg:w-1/3">

                <h1 class="text-center mb-3 text-3xl text-white">{{ __('Register') }}</h1>

                <form method="POST" action="{{ route('register') }}"
                      class="flex flex-col space-y-4">
                    @csrf

                    <div class="w-full flex flex-col space-y-2">
                        <input id="name" type="text"
                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                               value="{{ old('name') }}" required autofocus
                               placeholder="Name">

                        @if ($errors->has('name'))
                            <div class="text-red-200 font-semibold px-4">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="w-full flex flex-col space-y-2">

                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required
                               placeholder="Email">

                        @if ($errors->has('email'))
                            <div class="text-red-200 font-semibold px-4">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="w-full flex flex-col space-y-2">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" required
                               placeholder="Password">

                        @if ($errors->has('password'))
                            <div class="text-red-200 font-semibold px-4">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="w-full flex flex-col space-y-2">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required
                               placeholder="Confirm Password">

                    </div>

                    <div class="w-full flex justify-center flex-col items-center space-y-4">
                        <button type="submit"
                                class="border-4 border-white rounded-full text-white text-xl py-2 px-14 block">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection
