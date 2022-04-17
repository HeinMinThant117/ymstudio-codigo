<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($validated)) {
            $token = auth()->user()->createToken('GeneralToken');
            $this->logInfo('Token',  $token->toArray()['token']['id'], 'created');
            return response()->json([
                'data' => [
                    'token' => $token->accessToken,
                    'token_id' => $token->toArray()['token']['id'],
                    'user_id' => auth()->id(),
                    'name' => auth()->user()->name
                ]
            ], 200);
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

        $user = $this->userRepository->createUser(Arr::only($validated, ['name', 'email', 'password']));
        $this->logInfo('User', $user->id, 'created');

        return response()->json(['message' => 'success'], 201);
    }

    public function logout()
    {
        $token = auth()->user()->token();
        $token->delete();

        $this->logInfo('Token', $token->id, 'deleted');

        return response()->noContent();
    }

    protected function logInfo($object, $id, $action)
    {
        if (!App::environment('testing')) {
            Log::channel('mystudio')->info("$object with id \"${id}\" ${action} at " . Carbon::now()->timezone('Asia/Rangoon'));
        }
    }
}
