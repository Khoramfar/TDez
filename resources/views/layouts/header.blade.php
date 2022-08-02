<div class="topbar container-fluid  p-1 text-white text-center ">
    <p class="topbartext">پیشنهاد ویژه : بلیط رایگان نمایش به مناسبت افتتاح وب سایت</p>
</div>
<nav class="navbar pt-2 p-2 navbar-expand-sm bg-light navbar-dark sticky-top border-bottom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="/img/logo.png" alt="Avatar Logo" style="width:70px;" >
            <span class="logoname">تیکدز</span>
        </a>

        <div class="d-flex">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}"><button type="button" class="btn btn-success ms-2">حساب کاربری</button></a>
                        <!-- Authentication -->
                        <form class="d-inline" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a  href="{{ route('logout') }}"><button type="submit" class="btn btn-danger ms-2">خروج</button></a>
                        </form>

                    @else
                        <a href="{{ route('login') }}" ><button type="button" class="btn btn-danger" > ورود </button></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" ><button type="button" class="btn btn-success ms-2">ثبت نام</button></a>
                        @endif
                    @endauth
                </div>
            @endif




        </div>

    </div>
</nav>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">  <span class="fas fa-home"></span> خانه </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('faq') }}">سوالات متداول</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rules') }}">قوانین و مقررات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">درباره ما</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">تماس با ما</a>
                </li>
            </ul>
        </div>
            <form name="frm1" class="d-flex" action="{{ route('TheaterSearch') }}" method="GET">
            <input class="form-control me-2" type="text" name="search" placeholder="جستجوی رویداد" required/>
            <button form="form1" class="btn btn-secondary" type="submit">برو</button>
            </form>
    </div>
</nav>
