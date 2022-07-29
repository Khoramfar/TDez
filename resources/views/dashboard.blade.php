@extends('layouts.userpanel')
@section('title', 'پنل کاربری')
@section('sidebar')

@endsection
@section('insidebox')
    <div class="container  mt-3 ">
        <img class="mx-auto d-block" src="/img/userpanel.png" alt="Logo" style="width:200px;">
        <h2 class="text-center">{{Auth::user()->name}}  عزیز، خوش اومدی!😍</h2>
        <div class="mt-4 p-5 bg-warning text-dark rounded mb-3 me-3 ms-3">
            <h1 class="mb-3">اینجا کجاست؟🤔</h1>
            <p class="h6" >
              در اینجا میتونی با کمک لینک های قسمت صفحات کاربری، حساب خودت رو مدیریت کنی و بلیط های گذشته دسترسی داشته باشی
            </p>
        </div>

        <div class="mt-4 p-5 bg-success text-white rounded mb-5 me-3 ms-3">
            <h1>اگر نیاز به راهنمایی داری</h1>
            <p>
              و یا مشکلی برای حسابت پیش اومده و دسترسی کامل نداری، با پشتیبانی تماس بگیر 😊
            </p>
        </div>

    </div>
@endsection
