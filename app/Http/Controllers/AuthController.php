<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'OK'], 200);
        }

        return response()->json(['message' => 'FAILED'], 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['message' => 'OK'], 200);
    }
}
