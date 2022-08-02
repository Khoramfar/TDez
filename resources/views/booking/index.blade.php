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
@section('title', 'بلیط های من')
@section('sidebar')

@endsection
@section('insidebox')
    <div class="container  mt-3 ">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p class="h6 mt-1">
                در این قسمت میتوانید بلیط های رزروی خود را مشاهده کرده و برای ورود به سالن دریافت کنید.
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
        <img class="mx-auto d-block" src="/img/Tickets.png" alt="Logo" style="width:200px;">

        <table class="table table-light table-striped">
            <thead>
            <tr>
                <th class="bg-dark text-white">نام رویداد</th>
                <th class="bg-dark text-white">زمان اجرا</th>
                <th class="bg-dark text-white">تعداد بلیط</th>
                <th class="bg-dark text-white">مشاهده</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Bookings as $B)
                <tr>
                    <td> {{$B->show->theater->title}}</td>
                    <td>
                        @php
                            echo PersianNumbersToEnglish(\Morilog\Jalali\CalendarUtils::strftime('%A, %d %B %Y', strtotime($B->show->show_date)));
                        @endphp
                        ساعت
                        @php
                            echo PersianNumbersToEnglish($B->show->show_time);
                        @endphp
                    </td>

                    <td>
                        {{PersianNumbersToEnglish($B->tickets->count())}}
                    </td>
                    <td>
                         <a href="{{route('ShowBooking',[$B->id])}}" target="_blank"> <button type="button" class="btn btn-danger" > مشاهده بلیط</button></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>


@endsection
