@extends('layouts.fullwidth')
@section('title', 'جستجو')
@section('insidebox')
    <div class="container  mt-3 ">
        <img class="mx-auto d-block" src="/img/search.png" alt="search" style="width:200px;">
        <h2 class="text-center">نتایج جستجو در رویدادها</h2>
        @if($theaters->isNotEmpty())
            <div class="row text-center mb-5">
            @foreach ($theaters as $T)
                <div class="col-sm-6 col-lg-3 ">
                    <div class="thumbnail theaterbox m-2 rounded">
                        <img src="{{Storage::url('public/files/'.$T->cover_file_name)}}"  width="100%" height="200">
                        <p class="alert  btn-dark"><strong> {{$T->title}}</strong></p>
                        <a href="{{route('TheaterBuy',[$T->id])}}"> <button class="btn btn-danger mb-3"><span class="fas fa-shopping-cart"></span> خرید بلیط </button></a>
                    </div>
                </div>
            @endforeach
            </div>
        @else
            <div  class="d-block my-4">
                <h2>متاسفانه رویدادی پیدا نشد :(</h2>
            </div>
        @endif

    </div>
@endsection
