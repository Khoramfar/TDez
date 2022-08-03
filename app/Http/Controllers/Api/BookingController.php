<?php

namespace App\Http\Controllers\Api;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Booking;
use App\Models\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{

    public function TicketCheck(Request $request)
    {
        $booking = Booking::find($request->id);
        if (! Gate::allows('show_ticket',$booking)) {
            return 'Access Denied!';
        }
        $booking->load('customer');
		return response()->json($booking->load('tickets'));
    }


}
