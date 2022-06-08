<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
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
            return response()->json(['message' => 'OK', "data" => Auth::user()], 200);
        }

        return response()->json(['message' => 'FAILED', "data" => null], 400);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'OK', "data" => null], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'birth_date' => 'required'
        ]);

        $user = User::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $teacher = Teacher::firstOrCreate([
            'user_id' => $user->id,
            'birth_date' => $request->birth_date
        ]);

        return response()->json(['message' => 'OK', "data" => $user], 201);
    }
}
