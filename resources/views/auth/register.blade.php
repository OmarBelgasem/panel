@extends('layouts.app')

@section('content')
        <div class="flex items-center justify-center mt-12">
           <div class="lg:w-1/2 xl:max-w-screen-sm bg-white pb-12">
                    <div class="cursor-pointer flex items-center mt-10">
                </div>
                <div class="mt-2 px-12 sm:px-24 md:px-48 lg:px-12 xl:px-24 xl:max-w-2xl">
                    <div class="text-center text-4xl text-blue-blue font-display font-semibold lg:text-left xl:text-5xl
                    xl:text-bold">{{ __('Register') }}</div>
                    <div class="mt-12">
                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="text-gray-gray">{{ __('Name') }}</label>

                            <div class="mt-2 mb-6">
                                <input id="name" type="text" class="outline-none focus:ring rounded w-full @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="text-gray-gray">{{ __('E-Mail Address') }}</label>

                            <div class="mt-2 mb-6">
                                <input id="email" type="email" class="outline-none focus:ring rounded w-full @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="text-gray-gray">{{ __('Password') }}</label>

                            <div class="mt-2 mb-6">
                                <input id="password" type="password" class="outline-none focus:ring rounded w-full @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="text-gray-gray">{{ __('Confirm Password') }}</label>

                            <div class="mt-2 mb-6">
                                <input id="password-confirm" type="password" class="outline-none focus:ring rounded w-full" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                        <div class="mt-12 text-sm font-display font-semibold text-gray-gray text-center">
                            Don't have an account ? <a href="/login" class="cursor-pointer text-indigo-600 hover:text-indigo-800"> Sign in </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
