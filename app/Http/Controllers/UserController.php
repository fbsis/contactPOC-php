<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use \App\Models\User;

class UserController extends Controller
{
    /**
     * login of user controller
     *
     * @return json Token
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid login details',
                'success' => false
            ], 401);
        }
        $user = JWTAuth::user();
        
        return response()->json([
            'message' => 'Login Successfully',
            'success' => true,
            'data' => $token,
            'user' => $user,
            'roles' => User::find($user['id'])->roles
        ], 200);
    }
}
