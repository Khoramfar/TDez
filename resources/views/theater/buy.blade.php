@extends('layouts.fullwidth')
@section('title', 'خرید بلیط')
@section('insidebox')
    @php
        function PersianNumbersToEnglish($input)
                           {
                               $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '۶', '۶', '۷', '۸', '۹'];
                               $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
                               return str_replace($english, $persian, $input);
                           }
                use Morilog\Jalali\Jalalian;
    @endphp
    <div class="container  mt-3 ">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li >{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
            <img class="mx-auto d-block rounded-3 img-thumbnail" style="width:200px;" src={{$cover_url}}  >
            <h2 class="text-center my-3">رزرو بلیط {{$theater->title }}</h2>
            <div class="col-lg-9 col-md-12 mx-auto">
            <table class="table table-warning table-striped mt-3">
                <thead>
                <tr >
                    <th class="bg-dark text-white">تاریخ اجرا</th>
                    <th class="bg-dark text-white">ساعت اجرا</th>
                    <th class="bg-dark text-white">محل برگزاری</th>
                    <th class="bg-dark text-white">رزرو</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($shows as $S)
                    <tr>
                        <td>
                            @php
                                echo PersianNumbersToEnglish(\Morilog\Jalali\CalendarUtils::strftime('%A, %d %B %Y', strtotime($S->show_date)));
                            @endphp
                        </td>
                        <td>
                            ساعت
                            @php
                                echo PersianNumbersToEnglish($S->show_time);
                            @endphp
                        </td>
                        <td>
                            {{$S->salon->name}}
                        </td>
                        <td>
                            <button type="button" onclick="editsalon({{$S->id}})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buyticket" > انتخاب صندلی</button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            </div>
        <div class="mt-1 p-3 bg-warning text-dark rounded mb-5 me-3 ms-3">
            <h1>درباره رویداد</h1>
            <p>
                {{$theater->description }}
            </p>
        </div>

    </div>

    <!-- Class Modal -->
    <div class="modal fade" id="buyticket">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h4 class="modal-title">{{$theater->title}} </h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="buyticketbody">
                    <div class="spinner-border"></div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">خروج</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        function editsalon(id) {
            $.get("/shows/" + id, function(data, status){
                document.getElementById("buyticketbody").innerHTML = data;
            });
        }
    </script>
@endsection
