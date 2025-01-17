<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;
    /**
     * Login api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) // TODO make Validation Request
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken(env('APP_NAME'))->plainTextToken;
            $success['user'] =  $user;
            // TODO make resource for user
            return $this->successResponse($success, 'User login successfully.');
        }
        else{
            return $this->errorResponse('Email or password is incorrect.', 401);
        }
    }
}
