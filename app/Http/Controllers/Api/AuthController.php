<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    private $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
    
        // all good so return the token
        return response()->json(compact('token'));
    }
    
    public function logout(Request $request)
    {
        try{
            if(JWTAuth::invalidate())
                return response()->json(['success' => true]);
            else
                return esponse()->json(['success' => false, 'msg'   =>  'Ops. Something went wrong!']);
        } catch(JWTException $ex) {
            return response()->json(['success' => false, 'msg'  =>  $ex->getMessage()]);
        }
    }
    
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     =>  'required|email',
            'password'  =>  'required',
            'name'  =>  'required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'success'   =>  false,
                'msg'       =>  $validator->errors()->first()
            ]);
        }
        
        if($this->userService->create($request->all()))
            return response()->json(['success'   =>  true]);
        else
            return response()->json([
                'success'   =>  false,
                'msg'       =>  'Something went wrong!'
            ]);
    }
}
