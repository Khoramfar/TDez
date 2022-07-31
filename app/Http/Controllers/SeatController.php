<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Salon;
use App\Models\Seat;
use App\Models\Theater;
use Illuminate\Http\Request;
use Redirect;
class SeatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'row' => 'required|numeric|max:255',
            'count' => 'required|numeric|max:255'
        ]);
        $seat = Seat::where('class_id', '=', $request->classid)->where('row', '=', $request->row)->first();
        if ($seat !== null)
        {
            return Redirect::back()->withErrors(['ردیف مورد نظر تکراری است و قبلا ثبت شده است.']);
        }
        $seat = Seat::Create(["class_id" =>$request->classid, "row" =>$request->row , "count" =>$request->count ]);
        $class = Classe::find($request->classid);
        $class->Seats()->save($seat);
        $message = 'ردیف صندلی با موفقیت ثبت شد.';
        return redirect()->back()->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function edit(Seat $seat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seat $seat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat $seat)
    {
        //
    }
}
