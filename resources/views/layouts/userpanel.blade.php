@extends('layouts.main')
@section('insidetop')

    <section class="mybg container-fluid">
        <div class="container">
                <div class="titlebox">
                    <h1 class="h2"><strong> @yield('title') </strong></h1>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #212529; height: 2px">
                </div>
            <div class="container">
            <div class="row" style="justify-content: center;">
            <div class="sidebarbox col-sm-12  col-md-3">
                <h3 class="h4 text-center my-3"><span class="fas fa-navicon mx-2 h5"></span>  صفحات کاربری</h3>

                <hr class=" mx-auto" style="width: 60px; background-color: #212529; height: 2px">
                @if((auth()->user()->role_id == '1') )
                <a href="{{route('theaterIndex')}}" >  <button class="btn btn-outline-dark my-1 w-100"><span class="fas fa-link"></span> مدیریت رویدادها </button>  </a>
                <a href="{{route('salonIndex')}}" >  <button class="btn btn-outline-dark my-1 w-100"><span class="fas fa-link"></span> مدیریت سالن ها </button>  </a>
                @endif
                @if((auth()->user()->role_id == '1') || auth()->user()->role_id == '2')
                    <a href="{{route('ShowIndex')}}" >  <button class="btn btn-outline-dark my-1 w-100"><span class="fas fa-link"></span> رویدادهای من </button>  </a>
                @endif
                <a href="{{route('BookingIndex')}}" >  <button class="btn btn-outline-dark my-1 w-100"><span class="fas fa-link"></span> خریدهای من </button>  </a>

                <h3 class="h4 text-center my-3"><span class="fas fa-user mx-2 h5"></span>  مشخصات کاربری</h3>
                <hr class=" mx-auto" style="width: 60px; background-color: #212529; height: 2px">
                <div class="usertypebox py-2">

                    <strong class="me-2 "><span class="fas fa-child mx-2 h5"></span>نام:</strong>
                    <span class="text-dark">{{Auth::user()->name}}</span>
                </div>
                <div class="usertypebox py-2">
                    <strong><span class="fas fa-ranking-star mx-2 h5"></span>سطح کاربری:</strong>
                    <span class="text-dark">
                    @php
                        if(auth()->user()->role_id == '1')
                         {
                             $role = 'مدیر کل سایت';
                         }
                         elseif(auth()->user()->role_id == '2')
                         {
                             $role = 'مدیر نمایش';
                         }
                         elseif(auth()->user()->role_id == '3')
                         {
                             $role = 'کاربر عادی';
                         }
                         echo  $role;
                    @endphp
                    </span>
                </div>
                <div class="usertypebox py-2">
                    <strong><span class="fas fa-calendar mx-2 h5"></span>تاریخ عضویت:</strong>
                    <span class="text-dark">
        @php
            function PersianNumbersToEnglish($input)
                               {
                                   $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '٦', '۶', '۷', '۸', '۹'];
                                   $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
                                   return str_replace($english, $persian, $input);
                               }
                use Morilog\Jalali\Jalalian;
                    $date = Jalalian::fromCarbon(Auth::user()->created_at)->format('%A, %d %B %Y');
                    echo PersianNumbersToEnglish($date);
        @endphp
        </span>
                </div>
                @yield('sidebar')
            </div>
            <div class="fullwidthbox col-sm-12 col-md-8" >
                @yield('insidebox')
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
