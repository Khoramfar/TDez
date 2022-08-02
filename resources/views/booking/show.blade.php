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
@section('title', 'مشاهده بلیط')
@section('sidebar')

@endsection
@section('insidebox')
    <div class="container  mt-3 ">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p class="h6 mt-1">
                برای ورود به سالن تصویر بلیط زیر را به مسئول سالن نشان دهید.
            </p>
        </div>

        @foreach($Booking->tickets as $T)
            <div class="col-12 ">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-lg h-md-250 position-relative bg-warning ticketbg">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 btn btn-dark text-white">بلیط {{$Theater->title}}</strong>
                        <div class="d-flex mt-2 flex-row ">
                            <div class="col-3  d-flex flex-column ">
                                <h3 class="mb-1 btn btn-sm btn-light"><span class="fas fa-user"></span> خریدار</h3>
                                <div class="mb-1 text-dark">
                                    <strong class="btn btn-sm btn-dark">
                                        @php
                                            echo PersianNumbersToEnglish($Customer->name);
                                        @endphp
                                    </strong>
                                </div>
                            </div>

                            <div class="col-9  d-flex flex-column me-3 ">
                                <h3 class="mb-1 btn btn-sm btn-light"><span class="fas fa-calendar"></span> زمان رویداد</h3>
                                <div class="mb-1 text-dark">
                                    <strong class="btn btn-sm btn-dark">
                                        سانس ساعت
                                        @php
                                            echo PersianNumbersToEnglish($Show->show_time);
                                        @endphp
                                    </strong>

                                    <strong class="btn btn-sm btn-danger">
                                        @php
                                            echo PersianNumbersToEnglish(\Morilog\Jalali\CalendarUtils::strftime('%A, %d %B %Y', strtotime($Show->show_date)));
                                        @endphp
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 mt-3 text-dark mx-auto">
                            <strong class="btn btn-lg btn-dark me-auto d-inline-block">
                                کد بلیط:
                                @php
                                    echo PersianNumbersToEnglish($Booking->id);
                                @endphp
                            </strong>
                            <strong class="btn btn-lg btn-primary">
                                ردیف
                                @php
                                    echo PersianNumbersToEnglish($T->row);
                                @endphp
                            </strong>
                            <strong class="btn btn-lg btn-success">
                            صندلی
                                @php
                                    echo PersianNumbersToEnglish($T->name);
                                @endphp
                            </strong>

                        </div>

                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img class="img-thumbnail rounded my-auto d-block  mt-3 mb-3" src={{$cover_url}}  style="width:200px;">
                    </div>
                </div>
            </div>
        @endforeach



@endsection
