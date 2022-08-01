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
        <img class="mx-auto d-block" src="/img/userpanel.png" alt="Logo" style="width:200px;">

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
                        <button type="button" onclick="classmanage({{$B->id}})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#showbooking" > مشاهده بلیط</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    <!-- Show Booking Modal -->
    <div class="modal fade" id="showbooking">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h4 class="modal-title">مشاهده بلیط</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="showbookingbody">
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
        function showbooking(id) {
            $.get("/salons/show/" + id, function(data, status){
                document.getElementById("showbookingbody").innerHTML = data;
            });
        }
    </script>

@endsection
