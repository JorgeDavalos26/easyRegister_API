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
            return response()->success(Auth::user());
        }

        return response()->error('Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->success(null);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'birth_date' => 'required'
        ]);

        if(User::where('email', $request->email)->exists())
        {
            return response()->error('Email repeated');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $teacher = Teacher::create([
            'user_id' => $user->id,
            'birth_date' => $request->birth_date
        ]);

        return response()->success($user, 201);
    }
}
