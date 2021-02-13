<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;


class AuthController extends Controller
{
    public function Login(Request $request) {
        if ($request) {
            foreach ($request->all() as $value) {
                if (auth()->attempt(['email' => $value['email'], 'password' => $value['password'],'status' => 1])) {
                    $this->setToken(Str::random(60));
                    return response()->json([
                        'api_token' => $user = auth()->user()->api_token,
                        'status' => true
                    ]);
                }
                return response()->json([
                    'error' => 'username or password is wrong!',
                    'code' => 401,
                ], 401);
            }
        }
    }

    private function setToken($token){
        $user = auth()->user();
        $user->api_token = $token;
        $user->save();
    }

    public function logout(){
        if (auth()->user()) {
            $this->setToken(null);
            return response()->json([
                'message' => 'Thank you for using our application'
            ]);
        }

        return response()->json([
            'error' => 'Unable to logout user',
            'code' => 401,
        ], 401);
    }
}
