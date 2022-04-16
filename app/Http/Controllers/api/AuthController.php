<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($validated)) {
            $token = auth()->user()->createToken('GeneralToken');
            return response()->json($token, 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
