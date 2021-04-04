<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid login details',
                'success' => false
            ], 401);
        }
        return response()->json([
            'message' => 'Login Successfully',
            'success' => true,
            'data'=> $token
        ], 401);

        return $token;
    }
}
