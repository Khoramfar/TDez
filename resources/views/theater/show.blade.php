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
					<h2 style="color:green;font-size:1.5em "> Theater Information: </h2>
					<hr>
					<img src={{$cover_url}} alt="Cover Image Avialable" style="width:200px;">
					<table>
					<tr><td style="color:blue;">id:</td><td>{{$theater->id}}</td></tr>
					<tr><td style="color:blue;">title:</td><td>{{$theater->title}}</td></tr>
					<tr><td style="color:blue;">description:</td><td>{{ $theater->description }}</td></tr>
					<tr><td style="color:blue;">created at:</td><td>{{$theater->created_at}}</td></tr>
					<tr><td style="color:blue;">last update:</td><td>{{$theater->updated_at}}</td></tr>
					</table>
					<hr>
					<h3 style="font-size:1.25em;color:#0083b3"> Prices: </h3>
					@foreach($theater->Prices as $price)
						<p><a href="#" class="underline">{{$price->Classe->Salon->name}}  {{$price->Classe->name}}    cost=${{$price->cost}}  </a></p>
					@endforeach
					<hr>
					<a href="{{ route('theaterIndex') }}" class="underline">  back  </a>
					<td><a href="{{ route('EditTheater',[$theater->id]) }}" class="underline" style="margin-left: 10px;" > edit </a></td>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color:#E74C3C">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h1> Add Price to Theater: </h1>

                    <form action="{{route('AddPriceToTheater')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 mt-3 ">      Price Class: </div>
                                <div class="col-lg-4 col-md-4  mt-3">
                                    <select class="form-control" name="classid" id="classid">
                                        <option value="" disabled selected>Select Class</option>
                                        @foreach($Clss as $Cls)
                                            <option value={{$Cls->id}}>{{$Cls->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 mt-3 "> Ticket Cost($): </div>
                                <div class="col-lg-4 col-md-4  mt-3"> <input  class="form-control" type="text" name="cost" placeholder="Enter Cost" required></div>
                            </div>

                            <input name="theaterid" type="hidden" value="{{$theater->id}}">

                            <div class="col-lg-2 col-md-2"> <button type="submit" class="btn btn-success"> Add </button></div>
                        </div>
                    </form>

                    <hr>
                    <h3 style="font-size:1.25em;color:#0083b3"> Shows: </h3>
                    @foreach($theater->shows as $show)
                        <p><a href="#" class="underline">  {{$show->date}} {{$show->salon_id}}  </a></p>
                    @endforeach
                    <hr>
                    <h1> Add Show to Theater: </h1>

                    <form action="{{route('AddShowToTheater')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 mt-3 ">      Salon : </div>
                                <div class="col-lg-4 col-md-4  mt-3">
                                    <select class="form-control" name="salonid" id="salonid">
                                        <option value="" disabled selected>Select Salon</option>
                                        @foreach($Slns as $Sln)
                                            <option value={{$Sln->id}}>{{$Sln->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 mt-3 ">      Admin : </div>
                                <div class="col-lg-4 col-md-4  mt-3">
                                    <select class="form-control" name="adminid" id="adminid">
                                        <option value="" disabled selected>Select User</option>
                                        @foreach($usrs as $usr)
                                            <option value={{$usr->id}}>{{$usr->email}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 mt-3 "> Date - Time: </div>
                                <div class="col-lg-4 col-md-4  mt-3"> <input type="datetime-local" id="showtime" name="showtime" required></div>
                            </div>

                            <input name="theaterid" type="hidden" value="{{$theater->id}}">

                            <div class="col-lg-2 col-md-2"> <button type="submit" class="btn btn-success"> Add </button></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
