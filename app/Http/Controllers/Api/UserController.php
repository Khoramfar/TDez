<?php

namespace App\Http\Controllers\Api;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|max:255',
        ]);

        if (Auth::attempt($credentials)) {

            $token = $request->user()->createToken('token');
            $email = Auth::user()->email;
            return ['token' => $token->plainTextToken, 'user' => $email];
        }

        return 'Login Failed';
    }

}
