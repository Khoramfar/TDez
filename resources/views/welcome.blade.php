@extends('layouts.main')
@section('title', 'فروش آنلاین بلیط تئاتر')
@section('insidetop')
    <div id="mycarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
                <img src="img/slide1.jpg" alt="TDez" class="d-block" style="width:100%">
                <div class="carousel-caption">
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="img/slide2.jpg" alt="Online Booking System" class="d-block" style="width:100%" >
                <div class="carousel-caption">
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="img/slide1.jpg" alt="New York" class="d-block" style="width:100%">
                <div class="carousel-caption">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
@endsection

@section('insidecont')
    <div class="bg-1">
        <div class="container mt-3">
            <h2 class="text-center alert  btn-dark">  <strong>رویدادهای جدید</strong></h2>
            <p class="text-center alert alert-info">برای انتخاب تاریخ رزرو و خرید بلیط بر روی تئاتر مورد نظر کلیک کنید.</p>
            <div class="row text-center mb-5">
                @foreach ($Ths as $T)
                    <div class="col-sm-6 col-lg-3 ">
                        <div class="thumbnail theaterbox m-2 rounded">
                            <img src="{{Storage::url('public/files/'.$T->cover_file_name)}}"  width="100%" height="200">
                            <p class="alert  btn-dark"><strong> {{$T->title}}</strong></p>
                            <button class="btn btn-danger mb-3"><span class="fas fa-shopping-cart"></span> خرید بلیط </button>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>



    <div class="container text-center bg-grey mb-4">
        <div class="row text-center slideanim">
            <div class="col-sm-4">
                <div class="thumbnail mx-lg-4">
                    <div class="boximg">
                        <img src="img/Clock.png" alt="صرفه جویی در وقت">
                    </div>
                    <h3 class="boxheading my-4">صرفه جویی در وقت</h3>
                    <p class="boxtext">مجبور نیستید هنگام تهیه بلیط به گیشه  یا سینما بروید، پارک کنید، راه بروید یا در یک اتاق انتظار بنشینید. می توانید از تخت یا مبل راحتی خود بلیط رزرو کنید</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail mx-lg-4">
                    <div class="boximg">
                        <img src="img/Cost.png" alt="کاهش هزینه مراجعات">
                    </div>
                    <h3 class="boxheading my-4">کاهش هزینه مراجعات </h3>
                    <p class="boxtext">با وجود شبکه‌ی حرفه‌ای تهیه بلیط و ارتباط مستقیم با برگزارکننده تئاتر، با اطمینان خاطر بلیط خود را به صورت اینترنتی رزرو کنید. </p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail mx-lg-4">
                    <div class="boximg">
                        <img src="img/Support.png" alt="ارتباط آنلاین با پشتیبانی">
                    </div>
                    <h3 class="boxheading my-4">ارتباط آنلاین با پشتیبانی</h3>
                    <p class="boxtext">می توانید سوالات خود را بدون محدودیت زمانی و مکانی از پشتیبانی آنلاین بپرسید و ظرف ۲۴ ساعت پاسخ را دریافت نمایید.</p>
                </div>
            </div>
        </div>
@endsection
