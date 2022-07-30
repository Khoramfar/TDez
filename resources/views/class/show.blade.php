@php
    function PersianNumbersToEnglish($input)
                       {
                           $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '۶', '۶', '۷', '۸', '۹'];
                           $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
                           return str_replace($english, $persian, $input);
                       }
            use Morilog\Jalali\Jalalian;
@endphp
<table>
    <div class="usertypebox py-2">
        <strong class="me-2 ">شماره کلاس:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish($class->id)}}</span>
    </div>
    <div class="usertypebox py-2">
        <strong class="me-2 ">تاریخ ثبت:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish(Jalalian::fromCarbon($class->created_at)->format('%A, %d %B %Y H:i:s' ))}}</span>
    </div>
    <div class="usertypebox py-2">
        <strong class="me-2 ">تاریخ بروزرسانی:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish(Jalalian::fromCarbon($class->updated_at)->format('%A, %d %B %Y H:i:s' ))}}</span>
    </div>
</table>
