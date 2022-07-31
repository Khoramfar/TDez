@extends('layouts.userpanel')
@section('title', 'مدیریت رویدادها')
@section('sidebar')

@endsection
@section('insidebox')
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

    <div class="container  mt-3 ">

        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p class="h6 mt-1">
                در این قسمت میتوانید رویداد جدید ایجاد کرده و اجراهای روزانه به آن اضافه کنید.
            </p>
        </div>
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
        <img class="mx-auto d-block" src="/img/userpanel.png" alt="Logo" style="width:200px;">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#theaters">لیست رویدادها</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#shows">لیست تمامی اجراها</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" data-bs-toggle="tab" href="#addnew">اضافه کردن رویداد</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="theaters" class="container tab-pane active"><br>  <!-- THEATERS TAB START-->
                <table class="table table-secondary table-striped">
                    <thead>
                    <tr>
                        <th>نام رویداد</th>
                        <th>مدیریت اجراها</th>
                        <th> قیمت گذاری</th>
                        <th>جزئیات و ویرایش</th>
                        <th>وضعیت نمایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Ths as $T)
                        <tr>
                            <td> {{$T->title}}</td>
                            <td>
                                <button type="button" onclick="showslist({{$T->id}})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showslist" > اجراها</button>
                            </td>
                            <td>
                                <button type="button" onclick="pricemanage({{$T->id}})" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#pricemanage" > قیمت </button>
                            </td>
                            <td>
                                <button type="button" onclick="edittheater({{$T->id}})" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edittheater" > جزئیات</button>
                            </td>
                            <td>
                                <form action="{{route('PublicTheater',[$T->id])}}" method="post">
                                    @csrf
                                    @if($T->public == 1 )
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
            <div id="shows" class="container tab-pane fade"><br>  <!-- SHOWS TAB START-->
                <table class="table table-warning table-striped mt-3">
                    <thead>
                    <tr>
                        <th>نام رویداد</th>
                        <th>تاریخ اجرا</th>
                        <th>ساعت اجرا</th>
                        <th>جزئیات و آمار</th>
                        <th>وضعیت نمایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Shows as $S)
                        <tr>
                            <td>{{$S->theater->title}}</td>
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
                                <button type="button" type="submit" class="btn btn-dark"  > جزئیات </button>
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
            <div id="addnew" class="container tab-pane fade"><br>  <!-- ADD THEATER TAB START-->
                <form action="{{route('AddTheater')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-floating mb-3 mt-3">
                        <input  class="form-control" type="text" name="title" placeholder="Enter title" required>
                        <label for="title">  نام رویداد:</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" id="comment" name="description" placeholder="توضیحات" required></textarea>
                        <label for="comment"> توضیحات تئاتر(برای مثال نام بازیگران و ژانر):</label>
                    </div>

                    <label for="cover" class="form-label mt-3">تصویر شاخص:</label>
                    <input class="form-control form-control-sm" name="cover" id="cover" type="file">
                     <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> اضافه کردن رویداد </button></div>
                </form>
            </div>
        </div>

    </div>
    <!-- Edit Theater Modal -->
    <div class="modal fade" id="edittheater">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h4 class="modal-title">ویرایش رویداد</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="edittheaterbody">
                    <div class="spinner-border"></div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">خروج</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Price Modal -->
    <div class="modal fade" id="pricemanage">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h4 class="modal-title"> قیمت بلیط</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="pricemanagebody">
                    <div class="spinner-border"></div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">خروج</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Shows Modal -->
    <div class="modal fade" id="showslist">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h4 class="modal-title">مدیریت اجراهای رویداد</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="showslistbody">
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
        function edittheater(id) {
            $.get("/theaters/" + id, function(data, status){
                document.getElementById("edittheaterbody").innerHTML = data;
            });
        }
        function pricemanage(id) {
            $.get("/theaters/" + id + "/price/", function(data, status){
                document.getElementById("pricemanagebody").innerHTML = data;
            });
        }
        function priceshow(id) {
            $.get("/theaters/price/" + id, function(data, status){
                document.getElementById("pricelistbody").innerHTML = data;
            });
        }
        function showslist(id) {
            $.get("/theaters/" + id + "/shows/", function(data, status){
                document.getElementById("showslistbody").innerHTML = data;
            });
        }
        $(document).ready(function () {
            $('#showslist').on('shown.bs.modal', function (e) {
                $('.observer-example').persianDatepicker({
                    observer: true,
                    format: 'YYYY/MM/DD',
                    altField: '.observer-example-alt'
                });
            });
        });

    </script>
@endsection
