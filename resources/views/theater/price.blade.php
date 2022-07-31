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
<h4 class="text-center mb-3">{{$theater->name}} قیمت گذاری</h4>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#addnewprice">افزودن قیمت جدید</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">لیست قیمتگذاری ها</a>
        <ul class="dropdown-menu">

            @foreach ($theater->prices as $P)
                <a class="nav-link" onclick="priceshow({{$P->id}})" data-bs-toggle="tab" href="#pricelistbody"> {{$P->classe->name}} - {{$P->classe->salon->name}} </a>
            @endforeach


        </ul>
    </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane container active" id="addnewprice">
        <form action="{{route('AddPriceToTheater')}}" method="post">
            @csrf
            <select class="form-select mt-4" name="classid" id="classid">
                <option value="" disabled selected>انتخاب کلاس</option>
                @foreach($Clss as $Cls)
                    <option value={{$Cls->id}}>{{$Cls->name}} {{$Cls->salon->name}}  </option>
                @endforeach
            </select>

            <div class="form-floating mb-3 mt-3">
                <input  class="form-control" type="number" name="cost" placeholder="Enter Cost" required>
                <label for="title">  قیمت بلیط (هزار تومان):</label>
            </div>
            <input name="theaterid" type="hidden" value="{{$theater->id}}">
            <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> اضافه کردن قیمت </button></div>

        </form>
    </div>
    <div class="tab-pane container fade" id="pricelistbody"> <div class="spinner-border"></div></div>
</div>







