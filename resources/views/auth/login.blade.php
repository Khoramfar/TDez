@extends('layouts.fullwidth')
@section('title', 'ورود به حساب کاربری')
@section('insidebox')
    <div class="container  mt-3 ">
        <img class="mx-auto d-block" src="/img/login.png" alt="Logo" style="width:200px;">


        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="col-lg-6 col-md-9 col-sm-12 mx-auto">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
                <div class="form-floating mb-3 mt-3">
                    <input  class="form-control" type="email" name="email" placeholder="email"  required />
                    <label for="name">  ایمیل:</label>
                </div>


            <!-- Password -->
                <div class="form-floating mb-3 mt-3">
                    <input  class="form-control" type="password" name="password" placeholder="Enter New Password" required autocomplete="new-password" required autocomplete="current-password" />
                    <label for="new_password">  کلمه عبور :</label>
                </div>


            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                    <div class="mx-auto my-4"> <button type="submit" class="btn btn-lg btn-success mx-auto d-block"> ورود </button></div>

            </div>
        </form>
        </div>

@endsection
