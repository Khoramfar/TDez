@extends('layouts.main')
@section('insidetop')
    <section class="mybg container-fluid">

        <div class="container">
                <div class="titlebox">
                    <h1 class="h2"><strong> @yield('title') </strong></h1>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #212529; height: 2px">
                </div>
        <div class="fullwidthbox">
            @yield('insidebox')
        </div>
        </div>
    </section>
@endsection
