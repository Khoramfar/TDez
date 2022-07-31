<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use App\Models\Ticket;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        $Ths = Theater::where('public', '=', '1')->get();
        return view('welcome',['Ths' => $Ths]);
    }


}
