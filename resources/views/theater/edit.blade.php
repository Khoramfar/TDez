<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<h1 style="color:green;font-size:1.5em "> Edit Theater Info: </h1>
					<hr>
					@if ($errors->any())
						<div>
							<ul>
								@foreach ($errors->all() as $error)
									<li style="color:#E74C3C">{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form action="{{route('UpdateTheater',[$theater->id])}}" method="post">
						@csrf

						Title: <input type="text" name="title" placeholder="Enter title" required value="{{$theater->title}}">
						<br>
                        <br>
                        Description: <textarea class="form-control" type="text" max=2030 name="description"  rows="4" cols="50"  required > {{$theater->description }} </textarea>
                        <br>
                        <button style="background-color: #04AA6D;    color: white;    padding: 10px 15px;    margin: 8px 0;    border: none;    cursor: pointer;    width: 15%;    opacity: 0.8;      font-weight: 600;"> Update </button>
					</form>
					<h3 style="font-size:1.25em;color:#0083b3"> Theater Shows: </h3>
					<hr>
					<table>

					</table>

					<hr>
					<a href="{{ route('theaterIndex') }}" class="underline">  بازگشت  </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
