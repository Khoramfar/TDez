<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Salon;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salon  $salon
     * @return \Illuminate\Http\Response
     */

    public function index(Salon $salon)
    {
        $salon->load('classes');
        return view('class.index',['salon' => $salon])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        ]);
        $class = Classe::Create(["name" =>$request->name ,"salon_id" =>$request->salon]);
        $salon = Salon::find($request->salon);
        $salon->Classes()->save($class);
        $message = 'کلاس با موفقیت ثبت شد.';
        return redirect()->back()->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $classe)
    {
        $classe->load('seats');
        $classe->seats->sortBy('row');
        return view('class.show',['class' => $classe])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function edit(Classe $classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classe $classe)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $classe->Update(["name" =>$request->name]);
        $message = 'کلاس با موفقیت بروزرسانی شد.';
        return redirect()->back()->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();
        $message = 'کلاس با موفقیت حذف شد.';
        return redirect()->back()->with('message', $message);
    }
}
