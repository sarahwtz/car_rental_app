<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;



class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

    if (! $token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
    

    ]);
    }

    

    public function logout() {
    JWTAuth::parseToken()->invalidate();
    return response()->json(['message' => 'Logged out successfully']);
}
    

    
    public function refresh() {
         $newToken = JWTAuth::parseToken()->refresh();

    return response()->json([
        'access_token' => $newToken,
        'token_type' => 'bearer',
            ]);

    }

    
    public function me() {
        return response()->json(auth()->user());
    }
}
