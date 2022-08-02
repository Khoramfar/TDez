@php
    function PersianNumbersToEnglish($input)
                       {
                           $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '۶', '۶', '۷', '۸', '۹'];
                           $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
                           return str_replace($english, $persian, $input);
                       }
            use Morilog\Jalali\Jalalian;
@endphp

<h4 class="text-center mb-3">{{$theater->title}}</h4>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#showlist">لیست اجراها</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-danger" data-bs-toggle="tab" href="#addnewshow">افزودن اجرای جدید</a>
    </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">

    <div class="tab-pane container fade" id="addnewshow">
        <form action="{{route('AddShowToTheater')}}" method="post">
            @csrf
            <label class="mt-3" for="adminid">  محل برگزاری:</label>
            <select class="form-control" name="salonid" id="salonid">
                <option value="" disabled selected>انتخاب سالن</option>
                @foreach($Slns as $Sln)
                    <option value={{$Sln->id}}>{{$Sln->name}} </option>
                @endforeach
            </select>

            <label class="mt-3" for="adminid">  مدیر فروش اجرا:</label>
            <select class="form-control mb-3 " name="adminid" id="adminid">

                <option value="" disabled selected>انتخاب کاربر</option>
                @foreach($usrs as $usr)
                    <option value={{$usr->id}}>{{$usr->email}} -  {{$usr->name}} </option>
                @endforeach
            </select>

            <div class="form-floating mb-3 mt-3">
                <input  class="form-control" type="number" name="showtime" placeholder="Enter time" required>
                <label for="showtime">  ساعت اجرا:</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input class="form-control observer-example" type="text" name="showdate" placeholder="Enter date" required>
                <label for="showdate"> تاریخ اجرا:</label>
            </div>

            <input name="theaterid" type="hidden" value="{{$theater->id}}">
            <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> اضافه کردن اجرا و بلیط ها </button></div>

        </form>
    </div>

    <div class="tab-pane container active" id="showlist">
        <table class="table table-warning table-striped mt-3">
            <thead>
            <tr>
                <th>تاریخ اجرا</th>
                <th>ساعت اجرا</th>
                <th>جزئیات و آمار</th>
                <th>وضعیت نمایش</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Shows as $S)
                <tr>
                    <td>
                        @php
                                echo PersianNumbersToEnglish(\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($S->show_date)));
                        @endphp
                    </td>
                    <td>
                        ساعت
                        @php
                            echo PersianNumbersToEnglish($S->show_time);
                        @endphp
                    </td>
                    <td>
                        <button type="button" onclick="showstats({{$S->id}})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showstats" > جزئیات و آمار</button>
                    </td>
                    <td>
                        <form action="{{route('PublicShow',[$S->id])}}" method="post">
                            @csrf
                        @if($S->public == 1 )
                        <button  type="submit"  class="btn btn-success"> فعال </button>
                        @else
                            <button  type="submit"  class="btn btn-danger"> غیرفعال </button>
                        @endif
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>


</div>






