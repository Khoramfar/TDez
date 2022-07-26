@extends('layouts.hello_layout')
@section('onvan', 'Salons')
@section('mohtava')
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default !important;
            text-decoration: none !important;
            color: #7F8C8D !important;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 style="color:green;font-size:1.5em "> Buy Show Tickets: </h2>
                    <hr>
                    <img src={{$cover_url}} alt="Cover Image Avialable" style="width:200px;">
                    <table>
                        <tr><td style="color:blue;">id:</td><td>{{$Show->id}}</td></tr>
                        <tr><td style="color:blue;">title:</td><td>{{$Show->theater->title}}</td></tr>
                        <tr><td style="color:blue;">description:</td><td>{{ $Show->theater->description }}</td></tr>
                        <tr><td style="color:blue;">Show Date:</td><td>{{$Show->show_date}}</td></tr>
                    </table>
                    <hr>
                    <a href="{{ route('ShowIndex') }}" class="underline">  back  </a>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color:#E74C3C">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h1> Seats: </h1>

                    <form action="{{route('AddBooking')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 mt-3 ">      Select Seats: </div>
                                <div class="col-lg-4 col-md-4  mt-3">
                                    <fieldset>
                                    @foreach($Show->tickets as $T)
                                            <input type="checkbox" name="tickets[]" value="{{$T->id}}"> {{$T->name}} <br>
                                        @endforeach
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 mt-3 "> Description: </div>
                                <div class="col-lg-4 col-md-4  mt-3"> <input  class="form-control" type="text" name="description" ></div>
                            </div>

                            <input name="showid" type="hidden" value="{{$Show->id}}">

                            <div class="col-lg-2 col-md-2"> <button type="submit" class="btn btn-success"> Buy Tickets </button></div>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
@endsection
