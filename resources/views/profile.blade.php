@php
    function PersianNumbersToEnglish($input)
                       {
                           $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '۶', '۶', '۷', '۸', '۹'];
                           $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
                           return str_replace($english, $persian, $input);
                       }
            use Morilog\Jalali\Jalalian;
@endphp
@extends('layouts.userpanel')
@section('title', 'پروفایل کاربری')
@section('sidebar')

@endsection
@section('insidebox')
    <div class="container  mt-3 ">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p class="h6 mt-1">
                در این قسمت میتوانید مشخصات و یا کلمه عبور خود را تغییر دهید.
            </p>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li >{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <img class="mx-auto d-block" src="/img/login.png" alt="Logo" style="width:200px;">

        <h3 class="btn btn-lg btn-dark"> تغییر مشخصات </h3>
        <form method="POST" action="{{ route('ChangeProfile') }}">
        @csrf

            <div class="form-floating mb-3 mt-3">
                <input  class="form-control" type="text" name="name" placeholder="Name" value="{{auth()->user()->name}}" required>
                <label for="name">  نام و نام خانوادگی:</label>
            </div>

            <div class="form-floating mb-3 mt-3">
                <input  class="form-control" type="text" name="phone" placeholder="Phone" value="{{auth()->user()->phone}}" required>
                <label for="phone">  شماره همراه:</label>
            </div>
            <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> ثبت مشخصات </button></div>

        </form>


        <h3 class="btn btn-lg btn-dark"> تغییر کلمه عبور </h3>
        <form method="POST" action="{{ route('ChangePassword') }}">
        @csrf
        <!-- Old Password -->
            <div class="form-floating mb-3 mt-3">
                <input  class="form-control" type="password" name="old_password" placeholder="Enter Old Password" required>
                <label for="old_password">  کلمه عبور قبلی:</label>
            </div>

            <!-- New Password -->
            <div class="form-floating mb-3 mt-3">
                <input  class="form-control" type="password" name="new_password" placeholder="Enter New Password" required>
                <label for="new_password">  کلمه عبور جدید:</label>
            </div>

            <!-- Confirm New Password -->
            <div class="form-floating mb-3 mt-3">
                <input  class="form-control" type="password" name="new_password_confirmation" placeholder="Confirm New Password" required>
                <label for="new_password_confirmation"> تکرار کلمه عبور جدید:</label>
            </div>
            <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> ثبت کلمه عبور </button></div>

        </form>


@endsection
