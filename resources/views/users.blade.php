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
@section('title', 'لیست کاربران')
@section('sidebar')

@endsection
@section('insidebox')
    <div class="container  mt-3 ">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p class="h6 mt-1">
                در این قسمت میتوانید مشخصات کاربران و سفارشات آن ها را مشاهده کنید.
            </p>
        </div>
        <img class="mx-auto d-block" src="/img/userpanel.png" alt="Logo" style="width:200px;">

        <table class="table table-light table-striped">
            <thead>
            <tr>
                <th class="bg-dark text-white">نام کاربر</th>
                <th class="bg-dark text-white">شماره تماس</th>
                <th class="bg-dark text-white">ایمیل</th>
                <th class="bg-dark text-white">سفارشات</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Users as $U)
                <tr>
                    <td> {{$U->name}}</td>
                    <td>{{PersianNumbersToEnglish($U->phone)}}</td>
                    <td>{{PersianNumbersToEnglish($U->email)}}</td>
                    <td>
                        <button type="button" onclick="bookings({{$U->id}})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookings" > سفارشات</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <!-- Show Stats Modal -->
        <div class="modal fade" id="bookings">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        <h4 class="modal-title">آمار خرید کاربر</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="bookingssbody">
                        <div class="spinner-border"></div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">خروج</button>
                    </div>

                </div>
            </div>
        </div>


        <script>
            function bookings(id) {
                $.get("/users/" + id, function(data, status){
                    document.getElementById("bookingssbody").innerHTML = data;
                });
            }
        </script>

@endsection
