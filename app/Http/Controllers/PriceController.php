<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Price;
use App\Models\Salon;
use App\Models\Theater;
use Redirect;
use Illuminate\Http\Request;

class PriceController extends Controller
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
    public function index(Theater $theater)
    {
        $theater->load('prices');
        $Cls = Classe::all();
        foreach($Cls as $C)
        {
            $C->load('salon');
        }
        return view('theater.price',['theater' => $theater , 'Clss' => $Cls] )->render();
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
            'cost' => 'required|numeric',
        ]);
        $theater = Theater::where('id', '=', $request->theaterid)->first();
        if ($theater === null)
        {
            return Redirect::back()->withErrors(['تئاتر مورد نظر یافت نشد']);
        }
        $class = Classe::where('id', '=', $request->classid)->first();
        if ($class === null)
        {
            return Redirect::back()->withErrors(['کلاس مورد نظر یافت نشد']);
        }
        $price = Price::where('theater_id', '=', $request->theaterid)->where('class_id', '=', $request->classid)->first();
        if ($price !== null)
        {
            return Redirect::back()->withErrors(['کلاس مورد نظر برای این رویداد از قبل قیمت دارد']);
        }
        $theater = Theater::find($request->theaterid);
        $class = Classe::find($request->classid);
        $price = Price::Create(["theater_id" =>$request->theaterid, "class_id" =>$request->classid, "cost" =>$request->cost]);
        $theater->Prices()->save($price);
        $class->Prices()->save($price);
        $message = 'قیمت گذاری با موفقیت ثبت شد.';
        return redirect()->back()->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        $Cls = Classe::all();
        foreach($Cls as $C)
        {
            $C->load('salon');
        }
        return view('theater.showprice',['price' => $price , 'Clss' => $Cls])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        $request->validate([
            'cost' => 'required|numeric',
        ]);
        $class = Classe::where('id', '=', $request->classid)->first();
        if ($class === null)
        {
            return Redirect::back()->withErrors(['کلاس مورد نظر یافت نشد']);
        }

        if ($price->class_id !== $request->classid)
        {
            $duplicate_price = Price::where('theater_id', '=', $price->theater_id)->where('class_id', '=', $request->classid)->first();
            if ($duplicate_price !== null)
            {
                return Redirect::back()->withErrors(['کلاس مورد نظر برای این رویداد از قبل قیمت دارد']);
            }
        }
        $class = Classe::find($request->classid);
        $price->Update(["class_id" =>$request->classid, "cost" =>$request->cost]);
        $class->Prices()->save($price);
        $message = 'قیمت گذاری با موفقیت بروزرسانی شد.';
        return redirect()->back()->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        //
    }
}
