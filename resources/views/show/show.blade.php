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
<div class="d-block mx-auto mb-2 text-center">
نمونه صندلی قابل خرید
<input class="btn-check d-inline" type="checkbox" name="tickets[]" id="btn-check-outlinedtest" value="" autocomplete="off" >
<label class="btn btn-outline-success btn-sm seatsize" for="btn-check-outlinedtest">۱</label>
    نمونه صندلی فروخته شده
    <input class="btn-check d-inline" type="checkbox" name="tickets[]" id="btn-check-outlinedtest2" value="" autocomplete="off" disabled>
    <label class="btn btn-danger btn-sm seatsize" for="btn-check-outlinedtest2">۱</label>
</div>

<form action="{{route('AddBooking')}}" method="post" >
    @csrf
    <fieldset>
    @foreach($Show->tickets->groupBy('class_name') as $classname => $rows)
       <h1> {{$classname}}</h1>
        @foreach($rows->sortBy('row')->groupBy('row') as $rowname => $tickets)
            <div class="card-header">
                <span class="h6 btn-sm btn-warning text-dark "> ردیف {{PersianNumbersToEnglish($rowname)}}</span>
                @foreach($tickets as $T)
                    @if($T->status=='free')
                        <input class="btn-check d-inline" type="checkbox" name="tickets[]" id="btn-check-outlined{{$T->id}}" value="{{$T->id}}" autocomplete="off" >
                        <label class="btn btn-outline-success btn-sm seatsize" for="btn-check-outlined{{$T->id}}">{{PersianNumbersToEnglish($T->name)}}</label>
                    @else
                        <input class="btn-check d-inline" type="checkbox" name="tickets[]" id="btn-check-outlined{{$T->id}}" value="{{$T->id}}" autocomplete="off" disabled >
                        <label class="btn btn-danger btn-sm seatsize" for="btn-check-outlined{{$T->id}}">{{PersianNumbersToEnglish($T->name)}}</label>

                    @endif

                @endforeach
            </div>
        @endforeach
        <br>
    @endforeach
    </fieldset>

    <div class="form-floating">
        <textarea class="form-control" id="description" name="description" placeholder="توضیحات" ></textarea>
        <label for="description"> توضیحات:</label>
    </div>
    <input name="showid" type="hidden" value="{{$Show->id}}">

    <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> پرداخت و ثبت خرید</button></div>

</form>
