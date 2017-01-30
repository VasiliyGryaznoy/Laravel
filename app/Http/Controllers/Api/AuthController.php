<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Signup;
use App\Services\UserService;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    private $userService;
    
    public function __construct(UserService $userService)
    {
        
        $this->middleware('jwt.auth', ['only' => ['logout']]);
        $this->userService = $userService;
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response(['error' => 'could_not_create_token'], 500);
        }
        
        // all good so return the token
        return response(compact('token'));
    }
    
    public function logout(Request $request)
    {
        if (!JWTAuth::invalidate()) {
            return response(['msg'  =>  'Something went wrong'], 500);
        }
    }
    
    public function signup(Signup $request)
    {
        if($this->userService->create($request->all())) {
            return $this->authenticate($request);
        }
        else
            return response([
                'msg'       =>  'Something went wrong!'
            ], 500);
    }
}
