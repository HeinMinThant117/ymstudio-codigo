<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create(Arr::only($validated, ['name', 'email', 'password']));

        return response()->json(['message' => 'success'], 201);
    }

    public function logout(Request $request)
    {
        $token = auth()->user()->token();
        $token->delete();

        return response()->noContent();
    }
}
