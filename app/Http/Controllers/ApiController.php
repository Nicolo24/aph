<?php

namespace App\Http\Controllers;

use App\Models\Base;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // laravel 9
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken(auth()->user()->createToken('authToken')->plainTextToken);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function me()
    {
        $user = auth()->user();
        return response()->json($user->load(['center','province','zone','institution','usertype', 'resource']));        
    }
    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer'
        ]);
    }




}
