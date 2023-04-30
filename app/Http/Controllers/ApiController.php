<?php

namespace App\Http\Controllers;

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
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer'
        ]);
    }

    // function reports
    public function reports()
    {
        $reports = \App\Models\Report::with(['user','resource','reporttype'])->get();
        return response()->json($reports);
    }

    // function resources
    public function resources()
    {
        $resources = \App\Models\Resource::with(['resourcetype','center','province','zone','institution'])->get();
        return response()->json($resources);
    }




}
