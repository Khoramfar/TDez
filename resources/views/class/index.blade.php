@php
    function PersianNumbersToEnglish($input)
                       {
                           $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '۶', '۶', '۷', '۸', '۹'];
                           $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
                           return str_replace($english, $persian, $input);
                       }
            use Morilog\Jalali\Jalalian;
@endphp
<h4 class="text-center mb-3">{{$salon->name}}</h4>
<ul class="nav nav-tabs">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">لیست کلاس ها</a>
        <ul class="dropdown-menu">

            @foreach ($salon->classes as $C)
                <a class="nav-link" onclick="classshow({{$C->id}})" data-bs-toggle="tab" href="#classlistbody">{{$C->name}}</a>
            @endforeach


        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#addnewclass">افزودن کلاس جدید</a>
    </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane container active" id="addnewclass">
        <form action="{{route('AddClassToSalon')}}" method="post">
            @csrf
            <div class="form-floating mb-3 mt-3">
                <input  class="form-control" type="text" name="name" placeholder="Enter title" required>
                <label for="title">  نام بخش:</label>
            </div>
            <input name="salon" type="hidden" value="{{$salon->id}}">
            <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> اضافه کردن کلاس </button></div>

        </form>
    </div>
    <div class="tab-pane container fade" id="classlistbody"> <div class="spinner-border"></div></div>
</div>







