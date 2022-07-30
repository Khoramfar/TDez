<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use App\Models\Show;
use App\Models\Salon;
use App\Models\User;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class TheaterController extends Controller
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
        $Ths = Theater::all();
        return view('theater.index',['Ths' => $Ths]);
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1024',
            'cover' => 'required|mimes:jpg,bmp,png|max:2048'
        ]);


        $coverfile = $request->file('cover');
        $coverfilename = $coverfile->getClientOriginalName();
        $extension = $coverfile->extension();
        $newcoverfilename = sha1(time().'_'.rand(1000000000,1999999999).'_'.rand(1000000000,1999999999).'_'.$coverfilename);
        $newcoverfilename = $newcoverfilename.'.'.$extension;

        Storage::disk('local')->putFileAs(
            'public/files',
            $coverfile,
            $newcoverfilename
        );

        Theater::Create(["title" =>$request->title ,"description"=>$request->description, 'cover_file_name'=> $newcoverfilename, 'original_cover_file_name'=>$coverfilename]);
        $message = 'رویداد با موفقیت ثبت شد.';
        return redirect()->back()->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function show(Theater $theater)
    {
        $theater->load('shows');
        $Cls = Classe::all();
        $Slns = Salon::all();
        $usrs = User::all();
        $url = Storage::url('public/files/'.$theater->cover_file_name);
        return view('theater.show',['theater' => $theater,'cover_url'=>$url, 'Clss' => $Cls, 'Slns'=> $Slns, 'usrs'=> $usrs])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function edit(Theater $theater)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theater $theater)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1024',
        ]);

        $theater->Update(["title" =>$request->title ,"description"=>$request->description ]);
        $message = 'رویداد با موفقیت بروزرسانی شد.';
        return redirect()->back()->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theater $theater)
    {
        //
    }
}
