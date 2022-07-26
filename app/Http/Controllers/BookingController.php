<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Redirect;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $Bookings = Booking::where('customer_id', '=', $id)->get();
        return view('booking.index',['Bookings' => $Bookings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        $currentTime = Carbon::now();
        foreach ($request->tickets as $ticketid)
        {
            $selectedticket = Ticket::where('id', '=', $ticketid)->first();
            if($selectedticket->status != 'free')
            {
                return Redirect::back()->withErrors(['Seat is taken.Select Another Seat']);
            }
        }

        $created_booking =  Booking::Create(["customer_id" =>$id ,"payment_status"=>'success', 'description'=> $request->description, 'booking_date'=>$currentTime ]);
        foreach ($request->tickets as $ticketid)
        {
            $selectedticket = Ticket::where('id', '=', $ticketid)->first();
            $selectedticket->status ='taken';
            $selectedticket->booking_id= $created_booking->id;
            $selectedticket->update();
        }

        return redirect()->action([ShowController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        $booking->load('tickets');
        return view('booking.show',['Booking' => $booking]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
