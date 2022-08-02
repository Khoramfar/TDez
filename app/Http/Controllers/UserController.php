<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin')->only(['index','show']);

    }
    public function index()
    {
        $users = User::all()->sortBy('name');
        return view('users',['Users' => $users])->render();
    }
    public function show(User $user)
    {
        $id = $user->id;
        $Bookings = Booking::where('customer_id', '=', $id)->get();
        return view('usershow',['Bookings' => $Bookings,'user' => $user])->render();
    }

   public function profile()
   {
	   return view('profile');
   }

	public function passwordchange(Request $request)
   {
		$request->validate([
			'old_password' => 'required|string|max:255',
			'new_password' => 'required|string|max:255',
			'new_password_confirmation' => 'required|string|max:255',
		]);

		$credentials = [
			'email' => Auth::user()->email,
			'password' => $request->old_password,
		];

        if (!Auth::attempt($credentials)) {
            return Redirect::back()->withErrors(['کلمه عبور اشتباه است']);
		}
		if($request->new_password != $request->new_password_confirmation)
            return Redirect::back()->withErrors(['کلمه عبور جدید با هم تطابق ندارند ']);

		$new_password = Hash::make($request->new_password);
		Auth::user()->update(['password'=>$new_password]);
       $message = 'کلمه عبور با موفقیت تغییر یافت.';
       return redirect()->back()->with('message', $message);

   }
    public function profilechange(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:12'],
        ]);

        Auth::user()->update(['name'=>$request->name,'phone'=>$request->phone]);
        $message = 'مشخصات شما با موفقیت تغییر یافت.';
        return redirect()->back()->with('message', $message);

    }

}
