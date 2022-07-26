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
					<h2 style="color:green;font-size:1.5em "> Class Information: </h2>
					<hr>
					<table>
					<tr><td style="color:blue;">id:</td><td>{{$class->id}}</td></tr>
					<tr><td style="color:blue;">name:</td><td>{{$class->name}}</td></tr>
					<tr><td style="color:blue;">created at:</td><td>{{$class->created_at}}</td></tr>
					<tr><td style="color:blue;">last update:</td><td>{{$class->updated_at}}</td></tr>
					</table>
					<hr>
					<h3 style="font-size:1.25em;color:#0083b3"> Seats: </h3>
					@foreach($class->seats as $seat)
						<p><a href="#" class="underline">  {{$seat->name}}  </a></p>
					@endforeach
					<hr>
					<a href="{{ route('salonIndex') }}" class="underline">  back  </a>
                    <td><a href="{{ route('UpdateClass',[$class->id]) }}" class="underline" style="margin-left: 10px;" > edit </a></td>
                </div>
                <h1> Add Seat to Class: </h1>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color:#E74C3C">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('AddSeatToClass')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 mt-3 "> Seat Name: </div>
                            <div class="col-lg-4 col-md-4  mt-3"> <input  class="form-control" type="text" name="name" placeholder="Enter Seat Name" required></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 mt-3 "> Row: </div>
                            <div class="col-lg-4 col-md-4  mt-3"> <input  class="form-control" type="text" name="row" placeholder="Enter Row" required></div>
                        </div>
                        <input name="classid" type="hidden" value="{{$class->id}}">
                        <div class="col-lg-2 col-md-2"> <button type="submit" class="btn btn-success"> Add </button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
