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
		<h1 > MyTickets: </h1>
		<hr>
		<table>
		@foreach($Bookings as $B)
		<tr>
			<td><a href="{{route('ShowBooking',[$B])}}" class="underline"> {{$B->id}}  {{$B->booking_date}}   </a></td>
        </tr>
		@endforeach
		</table>
	</div>

	<hr>

@endsection

