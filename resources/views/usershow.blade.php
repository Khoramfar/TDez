@php
    function PersianNumbersToEnglish($input)
                       {
                           $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '۶', '۶', '۷', '۸', '۹'];
                           $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
                           return str_replace($english, $persian, $input);
                       }
            use Morilog\Jalali\Jalalian;
@endphp

<h3 class="h4 text-center my-3"><span class="fas fa-user mx-2 h5"></span>  مشخصات کاربر</h3>
<hr class=" mx-auto" style="width: 60px; background-color: #212529; height: 2px">
<div class="usertypebox py-2">

    <strong class="me-2 "><span class="fas fa-child mx-2 h5"></span>نام:</strong>
    <span class="text-dark">{{$user->name}}</span>
</div>
<div class="usertypebox py-2">
    <strong><span class="fas fa-ranking-star mx-2 h5"></span>سطح کاربری:</strong>
    <span class="text-dark">
                    @php
                        if (Auth::check()){
                             echo $user->role->tag;
                            }
                    @endphp
                    </span>
</div>
<div class="usertypebox py-2">
    <strong><span class="fas fa-calendar mx-2 h5"></span>تاریخ عضویت:</strong>
    <span class="text-dark">
        @php

            $date = Jalalian::fromCarbon($user->created_at)->format('%A, %d %B %Y');
            echo PersianNumbersToEnglish($date);
        @endphp
        </span>
</div>

<h3 class="btn btn-lg btn-dark"> لیست سفارشات  </h3>
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
