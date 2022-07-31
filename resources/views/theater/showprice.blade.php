@php
    if(!function_exists("PersianNumbersToEnglish")) {
        function PersianNumbersToEnglish($input)
                           {
                               $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '۶', '۶', '۷', '۸', '۹'];
                               $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
                               return str_replace($english, $persian, $input);
                           }
                           }
                use Morilog\Jalali\Jalalian;
@endphp
<table>

    <div class="usertypebox py-2">
        <strong class="me-2 ">شماره قیمت گذاری:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish($price->id)}}</span>
    </div>
    <div class="usertypebox py-2">
        <strong class="me-2 ">کلاس قیمت گذاری:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish($price->classe->name)}} {{$price->classe->salon->name}} </span>
    </div>
    <div class="usertypebox py-2">
        <strong class="me-2 ">تاریخ ثبت:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish(Jalalian::fromCarbon($price->created_at)->format('%A, %d %B %Y H:i:s' ))}}</span>
    </div>
    <div class="usertypebox py-2">
        <strong class="me-2 ">تاریخ بروزرسانی:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish(Jalalian::fromCarbon($price->updated_at)->format('%A, %d %B %Y H:i:s' ))}}</span>
    </div>
</table>
<form action="{{route('UpdatePrice',[$price->id])}}" method="post" >
    @csrf
    <select class="form-select mt-4" name="classid" id="classid">
        <option value="" disabled selected>تغییر کلاس</option>
        @foreach($Clss as $Cls)
            <option value={{$Cls->id}}>{{$Cls->name}} {{$Cls->salon->name}}  </option>
        @endforeach
    </select>
    <div class="form-floating mb-3 mt-3">
        <input  class="form-control" type="number" name="cost" placeholder="Enter Cost" value="{{$price->cost}}" required>
        <label for="title">  قیمت جدید (هزار تومان):</label>
    </div>
    <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> بروزرسانی </button>
        <button class="btn btn-danger"> حذف قیمت گذاری </button>
    </div>
</form>
