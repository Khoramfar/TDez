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
        <strong class="me-2 ">شماره سالن:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish($salon->id)}}</span>
    </div>
    <div class="usertypebox py-2">
        <strong class="me-2 ">تاریخ ثبت:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish(Jalalian::fromCarbon($salon->created_at)->format('%A, %d %B %Y H:i:s' ))}}</span>
    </div>
    <div class="usertypebox py-2">
        <strong class="me-2 ">تاریخ بروزرسانی:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish(Jalalian::fromCarbon($salon->updated_at)->format('%A, %d %B %Y H:i:s' ))}}</span>
    </div>
</table>
<form action="{{route('UpdateSalon',[$salon->id])}}" method="post">
    @csrf
    <div class="form-floating mb-3 mt-3">
        <input  class="form-control" type="text" name="name" placeholder="نام" value="{{$salon->name}}" required>
        <label for="name">  نام سالن:</label>
    </div>

    <div class="form-floating">
        <textarea class="form-control" id="comment" name="address" placeholder="آدرس" required>{{ $salon->address }}</textarea>
        <label for="comment"> آدرس:</label>
    </div>

    <div class="mx-auto my-4"> <button type="submit" class="btn btn-success" > بروزرسانی </button></div>

</form>

