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
        'expires_in' => JWTAuth::factory()->getTTL() * 60,

    ]);
    }



    public function logout() {
        return 'logout';
    }

    
    public function refresh() {
        return 'refresh';
    }

    
    public function me() {
        return 'me';
    }
}
