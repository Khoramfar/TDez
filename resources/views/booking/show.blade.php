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
            @foreach($Booking->tickets as $T)
                <tr>
                    <td><a href="{{route('ShowTickets',[$Booking])}}" class="underline">  {{$T->name}}   </a></td>
                </tr>
            @endforeach
        </table>
    </div>

    <hr>

@endsection

