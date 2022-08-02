<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Redirect;
class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $show = Show::where('id', '=', $request->showid)->first();
        if ($show === null)
        {
            return Redirect::back()->withErrors(['اجرای مورد نظر یافت نشد']);
        }
        if ($show->public == '0')
        {
            return Redirect::back()->withErrors(['اجرای مورد نظر غیرفعال است']);
        }
        $id = Auth::id();
        $currentTime = Carbon::now();
        foreach ($request->tickets as $ticketid)
        {
            $selectedticket = Ticket::where('id', '=', $ticketid)->first();
            if($selectedticket->status != 'free')
            {
                return Redirect::back()->withErrors(['صندلی انتخابی شما فروخته شده است. لطفا یک صندلی دیگر انتخاب کنید']);
            }
        }

        $created_booking =  Booking::Create(["customer_id" =>$id ,"show_id"=> $request->showid ,"payment_status"=>'success', 'description'=> $request->description, 'booking_date'=>$currentTime ]);
        foreach ($request->tickets as $ticketid)
        {
            $selectedticket = Ticket::where('id', '=', $ticketid)->first();
            $selectedticket->status ='taken';
            $selectedticket->booking_id= $created_booking->id;
            $selectedticket->update();
        }

        $message = 'بلیط شما با موفقیت ثبت شد. این بلیط از ناحیه کاربری قابل مشاهده و دریافت است. کد رهگیری بلیط:  ' . $created_booking->id ;
        return redirect()->back()->with('message', $message);
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
        $show = $booking->show;
        $theater = $show->theater;
        $customer = $booking->customer;
        $url = Storage::url('public/files/'.$theater->cover_file_name);
        return view('booking.show',['Booking' => $booking,'Theater' => $theater,'Customer' => $customer,'Show' => $show,'cover_url'=>$url]);
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
