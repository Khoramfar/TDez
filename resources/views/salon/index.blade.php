@extends('layouts.userpanel')
@section('title', 'مدیریت سالن ها')
@section('sidebar')

@endsection
@section('insidebox')
    <div class="container  mt-3 ">

        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p class="h6 mt-1">
                در این قسمت میتوانید سالن جدید ایجاد کرده و کلاس های قیمتی و چینش صندلی به آن اضافه کنید.
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
                <a class="nav-link active" data-bs-toggle="tab" href="#theaters">لیست سالن ها</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" data-bs-toggle="tab" href="#addnew">اضافه کردن سالن</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="theaters" class="container tab-pane active"><br>  <!-- Salons TAB START-->
                <table class="table table-secondary table-striped">
                    <thead>
                    <tr>
                        <th>نام سالن</th>
                        <th>کلاس قیمت</th>
                        <th>جزئیات و ویرایش</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Slns as $S)
                        <tr>
                            <td> {{$S->name}}</td>
                            <td>
                                <button type="button" onclick="classmanage({{$S->id}})" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#classmanage" > کلاس بندی</button>
                            </td>

                            <td>
                                <button type="button" onclick="editsalon({{$S->id}})" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edittheater" > جزئیات</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger"><span class="fas fa-remove"></span></button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div id="addnew" class="container tab-pane fade"><br>  <!-- ADD Salon TAB START-->
                <form action="{{route('AddSalon')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-floating mb-3 mt-3">
                        <input  class="form-control" type="text" name="name" placeholder="Enter title" required>
                        <label for="title">  نام سالن:</label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" id="comment" name="address" placeholder="آدرس" required></textarea>
                        <label for="comment"> آدرس:</label>
                    </div>

                    <div class="mx-auto my-4"> <button type="submit" class="btn btn-success"> اضافه کردن سالن </button></div>

                </form>
            </div>
        </div>

    </div>
    <!-- Edit Salon Modal -->
    <div class="modal fade" id="edittheater">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h4 class="modal-title">ویرایش سالن</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="editsalonbody">
                    <div class="spinner-border"></div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">خروج</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Class Modal -->
    <div class="modal fade" id="classmanage">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h4 class="modal-title">کلاس بندی</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="classmanagebody">
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
            $.get("/salons/show/" + id, function(data, status){
                document.getElementById("editsalonbody").innerHTML = data;
            });
        }

        function classmanage(id) {
            $.get("/salons/" + id + "/classes/", function(data, status){
                document.getElementById("classmanagebody").innerHTML = data;
            });
        }
        function classshow(id) {
            $.get("/salons/classes/" + id, function(data, status){
                document.getElementById("classlistbody").innerHTML = data;
            });
        }
    </script>

@endsection
