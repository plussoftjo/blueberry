<?php

namespace App\Http\Controllers\Api\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Orders;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Fetch Input
        $input = $request->all();
        // IF Right Values
        if (Auth::attempt(['phone' => $input['phone'], 'password' => $input['password']])) {
        // Auth User
        $user = Auth::User();
        $token = $user->createToken('auth')->accessToken; #Fetch Token


        //return data
        return response()->json([
        'token' => $token,
        'user' => $user,
        ], 200);
        }

        // if not correct
        return response()->json(['error' => 'Unauthorised'], 401);
    }

    // Auth -> Get User
    public function auth()
    {
        $user = Auth::User();

        return response()->json($user);
    }
}
