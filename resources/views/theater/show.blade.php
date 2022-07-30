@php
    function PersianNumbersToEnglish($input)
                       {
                           $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '۶', '۶', '۷', '۸', '۹'];
                           $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
                           return str_replace($english, $persian, $input);
                       }
            use Morilog\Jalali\Jalalian;
@endphp
<img class="img-thumbnail rounded mx-auto d-block mb-3" src={{$cover_url}}  style="width:200px;">

<table>
    <div class="usertypebox py-2">
        <strong class="me-2 ">شماره رویداد:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish($theater->id)}}</span>
    </div>
    <div class="usertypebox py-2">
        <strong class="me-2 ">تاریخ ثبت:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish(Jalalian::fromCarbon($theater->created_at)->format('%A, %d %B %Y H:i:s' ))}}</span>
    </div>
    <div class="usertypebox py-2">
        <strong class="me-2 ">تاریخ بروزرسانی:</strong>
        <span class="text-dark">{{PersianNumbersToEnglish(Jalalian::fromCarbon($theater->updated_at)->format('%A, %d %B %Y H:i:s' ))}}</span>
    </div>
</table>
<form action="{{route('UpdateTheater',[$theater->id])}}" method="post">
    @csrf
    <div class="form-floating mb-3 mt-3">
        <input  class="form-control" type="text" name="title" placeholder="Enter title" value="{{$theater->title}}" required>
        <label for="title">  نام رویداد:</label>
    </div>

    <div class="form-floating">
        <textarea class="form-control" id="comment" name="description" placeholder="توضیحات" required>{{ $theater->description }}</textarea>
        <label for="comment"> توضیحات تئاتر(برای مثال نام بازیگران و ژانر):</label>
    </div>

    <div class="mx-auto my-4"> <button type="submit" class="btn btn-success" > بروزرسانی </button></div>

</form>

