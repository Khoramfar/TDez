<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Show;
use App\Models\Salon;
use App\Models\Theater;
use App\Models\User;
use App\Models\Price;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
class ShowController extends Controller
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
        $Shows = Show::all();
        return view('show.index',['Shows' => $Shows]);
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
            'salonid' => 'required|string|max:255',
            'adminid' => 'required|string',
            'showtime' => 'required|date'
        ]);
        $salon = Salon::where('id', '=', $request->salonid)->first();
        $user = User::where('id', '=', $request->adminid)->first();
        $theater = Theater::where('id', '=', $request->theaterid)->first();
        if ($salon === null)
        {
            return Redirect::back()->withErrors(['Salon Not Found']);
        }
        if ($user === null)
        {
            return Redirect::back()->withErrors(['User Not Found']);
        }
        $salonclasses= $salon->Classes->pluck('id')->toArray();
        $theaterclasses = $theater->Prices->pluck('class_id')->toArray();
        $containsAllValues = !array_diff($salonclasses, $theaterclasses);
        if($containsAllValues == false)
        {
            return Redirect::back()->withErrors(['You Should Define Price for All of Selected Salon Classes']);
        }

        $created_show = Show::Create(["theater_id" =>$request->theaterid ,"salon_id"=>$request->salonid, 'admin_id'=> $request->adminid, 'show_date'=>$request->showtime,'public'=> '0','is_cancelled'=> '0' ]);

        foreach ($salon->Classes as $Cls)
        {
            $price = Price::where('theater_id', '=', $request->theaterid)->where('class_id', '=', $Cls->id)->first();
            foreach ($Cls->Seats as $Seat)
            {
                Ticket::Create(["name" =>$Seat->name ,"row"=>$Seat->row, 'cost'=> $price->cost, 'status'=>'free','show_id'=> $created_show->id ]);
            }
        }
        return redirect()->action([TheaterController::class, 'index']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function show(Show $show)
    {
        $show->load('tickets');
        $url = Storage::url('public/files/'.$show->theater->cover_file_name);
        return view('show.show',['Show' => $show,'cover_url'=>$url]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function edit(Show $show)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Show $show)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function destroy(Show $show)
    {
        //
    }
}
