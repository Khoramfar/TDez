<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use App\Models\Show;
use App\Models\Theater;
use App\Models\Classe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class SalonController extends Controller
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
        $Slns = Salon::all();
        return view('salon.index',['Slns' => $Slns]);
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:1024',
        ]);

        Salon::Create(["name" =>$request->name ,"address" =>$request->address]);
        $message = 'سالن با موفقیت ثبت شد.';
        return redirect()->back()->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function show(Salon $salon)
    {
        $salon->load('shows');
        return view('salon.show',['salon' => $salon])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function edit(Salon $salon)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salon $salon)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:1024',
        ]);

        $salon->Update(["name" =>$request->name ,"address"=>$request->address]);
        $message = 'سالن با موفقیت بروزرسانی شد.';
        return redirect()->back()->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salon $salon)
    {
        $salon->delete();
        $message = 'سالن با موفقیت حذف شد.';
        return redirect()->back()->with('message', $message);
    }


}
