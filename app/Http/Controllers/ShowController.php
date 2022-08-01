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
use Illuminate\Support\Facades\Auth;
use Redirect;
use Morilog\Jalali\Jalalian;
class ShowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin')->except(['show','index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $Shows = Show::where('admin_id', '=', $id)->get();
        return view('show.index',['Shows' => $Shows]);
    }

    public function showmanage(Theater $theater)
    {
        $Shows = $theater->shows;
        $Slns = Salon::all();
        $usrs = User::all();
        return view('show.showsmanage',['Shows' => $Shows,'theater' =>$theater, 'Slns'=> $Slns, 'usrs'=> $usrs]);
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
    function convertEnglishNumbersToPersian($input)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '٦', '۶', '۷', '۸', '۹'];
        $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
        return str_replace($persian, $english, $input);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        list($jy, $jm, $jd) = explode('/', $request->showdate);
        $gdate = (new Jalalian($this->convertEnglishNumbersToPersian($jy), $this->convertEnglishNumbersToPersian($jm), $this->convertEnglishNumbersToPersian($jd)))->toCarbon()->toDateString();
        if ( checkdate( $this->convertEnglishNumbersToPersian($jm), $this->convertEnglishNumbersToPersian($jd), $this->convertEnglishNumbersToPersian($jy) == false ))
        {
            return Redirect::back()->withErrors(['تاریخ وارد شده صحیح نیست']);
        }
        $request->validate([
            'salonid' => 'required|string|max:255',
            'adminid' => 'required|numeric',
            'theaterid' => 'required|numeric',
            'showtime' => 'numeric|min:1|max:24',
            'showdate' => 'required'
        ]);
        $salon = Salon::where('id', '=', $request->salonid)->first();
        $user = User::where('id', '=', $request->adminid)->first();
        $theater = Theater::where('id', '=', $request->theaterid)->first();
        if ($salon === null)
        {
            return Redirect::back()->withErrors(['سالن مورد نظر یافت نشد']);
        }
        if ($user === null)
        {
            return Redirect::back()->withErrors(['کاربر مورد نظر یافت نشد']);
        }
        if ($theater === null)
        {
            return Redirect::back()->withErrors(['رویداد مورد نظر یافت نشد']);
        }
        $salonclasses= $salon->Classes->pluck('id')->toArray();
        $theaterclasses = $theater->Prices->pluck('class_id')->toArray();
        $containsAllValues = !array_diff($salonclasses, $theaterclasses);
        if($containsAllValues == false)
        {
            return Redirect::back()->withErrors(['ابتدا از منوی قیمتگذاری برای تمامی کلاس های سالن انتخابی، قیمت تعیین کنید']);
        }

        $created_show = Show::Create(["theater_id" =>$request->theaterid ,"salon_id"=>$request->salonid, 'admin_id'=> $request->adminid, 'show_date'=>$gdate, 'show_time'=>$request->showtime,'public'=> '0' ]);
        if($user->role_id == '3')
        {
            $user->Update(["role_id" =>'2']);
        }
        foreach ($salon->Classes as $Cls)
        {
            $price = Price::where('theater_id', '=', $request->theaterid)->where('class_id', '=', $Cls->id)->first();
            foreach ($Cls->Seats->sortBy('row') as $Seat)
            {
                for($i=1; $i<=$Seat->count;$i++)
                    Ticket::Create(["name" =>$i ,"row"=>$Seat->row,"class_name"=>$Cls->name, 'cost'=> $price->cost, 'status'=>'free','show_id'=> $created_show->id ]);
            }
        }
        $message = 'اجرای جدید ثبت و بلیط ها با موفقیت صادر شد. هم اکنون می توانید وضعیت نمایش را عمومی کنید.';
        return redirect()->back()->with('message', $message);

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
        return view('show.show',['Show' => $show,'cover_url'=>$url])->render();
    }

    public function stats(Show $show)
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

    public function is_public(Request $request, Show $show)
    {
        if($show->public == 0 )
        {
            $show->Update(["public" =>'1']);
            $message = 'وضعیت نمایش عمومی شد و کاربران قادر به خرید بلیط هستند';
            return redirect()->back()->with('message', $message);
        }
        else {
            $show->Update(["public" =>'0']);
            $message = 'اجرا غیرفعال شد و کاربران قادر به خرید بلیط نیستند';
            return redirect()->back()->with('message', $message);
        }

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
