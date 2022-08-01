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
@section('title', 'اجرا های من')
@section('sidebar')

@endsection
@section('insidebox')
    <div class="container  mt-3 ">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p class="h6 mt-1">
                در این قسمت میتوانید اجرا های خود و آمار فروش را مشاهده کنید.
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
                <th class="bg-dark text-white">تاریخ اجرا</th>
                <th class="bg-dark text-white">ساعت اجرا</th>
                <th class="bg-dark text-white">جزئیات و آمار</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Shows as $S)
                <tr>
                    <td>{{$S->theater->title}}</td>
                    <td>
                        @php
                            echo PersianNumbersToEnglish(\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($S->show_date)));
                        @endphp
                    </td>
                    <td>
                        ساعت
                        @php
                            echo PersianNumbersToEnglish($S->show_time);
                        @endphp
                    </td>
                    <td>
                        <button type="button" onclick="showstats({{$S->id}})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#showstats" > جزئیات و آمار</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <!-- Show Stats Modal -->
        <div class="modal fade" id="showstats">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        <h4 class="modal-title">آمار فروش</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="showstatsbody">
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
            function showstats(id) {
                $.get("/salons/show/" + id, function(data, status){
                    document.getElementById("showstatsbody").innerHTML = data;
                });
            }
        </script>

@endsection
