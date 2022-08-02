@php
    function PersianNumbersToEnglish($input)
                       {
                           $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '۶', '۶', '۷', '۸', '۹'];
                           $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
                           return str_replace($english, $persian, $input);
                       }
            use Morilog\Jalali\Jalalian;
@endphp
<div class="usertypebox py-2">
    سانس ساعت
    @php
        echo PersianNumbersToEnglish($Show->show_time);
    @endphp
    روز
    @php
        echo PersianNumbersToEnglish(\Morilog\Jalali\CalendarUtils::strftime('%A, %d %B %Y', strtotime($Show->show_date)));
    @endphp
</div>

<div class="usertypebox py-2 text-success">
    تعداد صندلی فروخته شده:
    @php
        echo PersianNumbersToEnglish($taken_count);
    @endphp
</div>
<div class="usertypebox py-2 text-primary">
    تعداد صندلی آزاد:
    @php
        echo PersianNumbersToEnglish($free_count);
    @endphp
</div>
<table class="table table-light table-striped">
    <thead>
    <tr>
        <th class="bg-dark text-white">نام خریدار</th>
        <th class="bg-dark text-white">شماره تماس</th>
        <th class="bg-dark text-white">تعداد بلیط</th>
        <th class="bg-dark text-white">مشاهده بلیط</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($Bookings as $B)
        <tr>
            <td> {{$B->Customer->name}}</td>
            <td>{{PersianNumbersToEnglish($B->Customer->phone)}}</td>
            <td>{{PersianNumbersToEnglish($B->tickets->count())}}</td><td>
                <a href="{{route('ShowBooking',[$B->id])}}" target="_blank"> <button type="button" class="btn btn-danger" > مشاهده بلیط</button></a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
