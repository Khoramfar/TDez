@extends('layouts.fullwidth')
@section('title', 'ثبت نام')
@section('insidebox')
    <div class="container-fluid  mt-3 ">
        <img class="mx-auto d-block" src="/img/signup.png" alt="Logo" style="width:200px;">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="col-lg-6 col-md-9 col-sm-12 mx-auto">
                <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                    <div class="form-floating mb-3 mt-3">
                        <input  class="form-control" type="text" name="name" placeholder="Name"  required autofocus>
                        <label for="name">  نام و نام خانوادگی:</label>
                    </div>
                    <!-- Phone -->
                    <div class="form-floating mb-3 mt-3">
                        <input  class="form-control" type="text" name="phone" placeholder="Phone"  required>
                        <label for="phone">  شماره همراه:</label>
                    </div>

                    <!-- Email Address -->
                    <div class="form-floating mb-3 mt-3">
                        <input  class="form-control" type="email" name="email" placeholder="email"  required />
                        <label for="name">  ایمیل:</label>
                    </div>

                        <!-- Password -->
                        <div class="form-floating mb-3 mt-3">
                            <input  class="form-control" type="password" name="password" placeholder="Enter New Password" required autocomplete="new-password" />
                            <label for="new_password">  کلمه عبور :</label>
                        </div>


                        <!-- Confirm Password -->
                        <div class="form-floating mb-3 mt-3">
                            <input id="password_confirmation"  class="form-control" type="password" name="password_confirmation" placeholder="Enter New Password" required />
                            <label for="new_password">   تکرار کلمه عبور :</label>
                        </div>



                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                قبلا ثبت نام کرده اید؟
                            </a>

                            <div class="mx-auto my-4"> <button type="submit" class="btn btn-lg btn-success mx-auto d-block"> ثبت نام </button></div>

                        </div>
                </form>
            </div>
    </div>
@endsection

