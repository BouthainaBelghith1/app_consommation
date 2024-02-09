<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Login(AuthRequest $request)  {
        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){

            $user=Auth::user();
            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                "user"=>$user,
                "token"=>$token
            ],200);

        }else{
            return response()->json(["message"=>"User Not Found"],404);
        }
    }
}
