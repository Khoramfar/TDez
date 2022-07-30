@extends('layouts.userpanel')
@section('title', 'مدیریت رویدادها')
@section('sidebar')

@endsection
@section('insidebox')
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
                        <th>لیست قیمت</th>
                        <th>جزئیات و ویرایش</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Ths as $T)
                        <tr>
                            <td> {{$T->title}}</td>
                            <td>
                                <button type="button" class="btn btn-primary">مدیریت</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info">قیمت بلیط</button>
                            </td>
                            <td>
                                <button type="button" onclick="edittheater({{$T->id}})" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edittheater" > جزئیات</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger"><span class="fas fa-remove"></span></button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div id="shows" class="container tab-pane fade"><br>  <!-- SHOWS TAB START-->
                <h3>Menu 1</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
    <script>
        function edittheater(id) {
            $.get("/theaters/" + id, function(data, status){
                document.getElementById("edittheaterbody").innerHTML = data;
            });
        }
    </script>
@endsection
