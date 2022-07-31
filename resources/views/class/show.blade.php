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
<form action="{{route('UpdateClass',[$class->id])}}" method="post" >
    @csrf
    <div class="form-floating mb-3 mt-3">
        <input  class="form-control" type="text" name="name" placeholder="Enter title" value="{{$class->name}}" required>
        <label for="title"> نام بخش:</label>
    </div>
    <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> بروزرسانی کلاس </button>
        <button class="btn btn-danger"> حذف کلاس </button>
    </div>

</form>


<div class="modal-title d-block mx-auto">
    <h1 class="h3 text-center"><strong> مدیریت صندلی ها </strong></h1>
    <hr class="mb-4 mt-0 d-block mx-auto" style="width: 60px; background-color: #212529; height: 2px">
</div>
<form action="{{route('AddSeatToClass')}}" method="post"  >
    @csrf
    <div class="form-floating mb-3 mt-3">
        <input  class="form-control" type="number" name="row" placeholder="Enter name" required>
        <label for="title">  شماره ردیف :</label>
    </div>
    <div class="form-floating mb-3 mt-3">
        <input  class="form-control" type="number" name="count" placeholder="Enter row" required>
        <label for="title">  تعداد صندلی:</label>
    </div>
    <input name="classid" type="hidden" value="{{$class->id}}">
    <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> اضافه کردن ردیف صندلی </button></div>
</form>

<table class="table table-secondary table-striped">
    <thead>
    <tr>
        <th>شماره ردیف</th>
        <th>تعداد صندلی</th>
        <th>حذف</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($class->seats->sortBy('row') as $seat)
        <tr>
            <td> {{$seat->row}}</td>
            <td> {{$seat->count}}</td>
            <td>
                <button type="button" class="btn btn-danger"><span class="fas fa-remove"></span></button>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
