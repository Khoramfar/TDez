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
	<div class="p-6 bg-white border-b border-gray-200">
		<h1 > It is list of all Salons Created by you: </h1>
		<hr>
		<table>
		@foreach($Slns as $S)
		<tr>
			<td><a href="{{route('ShowSalon',[$S])}}" class="underline">  {{$S->name}}  </a></td>
		</tr>
		@endforeach
		</table>
	</div>

	<hr>
	<div class="p-6 bg-white border-b border-gray-200">
		<h1> Add a new Salon: </h1>
		@if ($errors->any())
			<div>
				<ul>
					@foreach ($errors->all() as $error)
						<li style="color:#E74C3C">{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<form action="{{route('AddSalon')}}" method="post" enctype="multipart/form-data" >
			@csrf
			<div class="container-fluid ">
				<div class="row">
					<div class="col-lg-2 col-md-2 mt-3 "> Name: </div>
					<div class="col-lg-4 col-md-4  mt-3"> <input  class="form-control" type="text" name="name" placeholder="Enter salon name" required></div>
				</div>
				<div class="row">
					<div class="col-lg-2 col-md-2 mt-3 "> Address: </div>
                    <div class="col-lg-4 col-md-4  mt-3"> <input  class="form-control" type="text" name="address" placeholder="Enter Address" required></div>
				</div>

				<div class="col-lg-2 col-md-2"> <button type="submit" class="btn btn-success"> Add </button></div>
			</div>
		</form>

        <h1> Add a New Class to Salon: </h1>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:#E74C3C">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('AddSalon')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-lg-2 col-md-2 mt-3 "> Name: </div>
                    <div class="col-lg-4 col-md-4  mt-3"> <input  class="form-control" type="text" name="name" placeholder="Enter Class name" required></div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 mt-3 "> Salon: </div>
                    <div class="col-lg-4 col-md-4  mt-3"> <input  class="form-control" type="text" name="salon_id" placeholder="Enter Address" required></div>
                </div>

                <div class="col-lg-2 col-md-2"> <button type="submit" class="btn btn-success"> Add </button></div>
            </div>
        </form>
	</div>
@endsection

