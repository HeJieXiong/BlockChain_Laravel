<?php

namespace App\Http\Controllers\Api;
use Auth;
use Validator;
use Hash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\AuthControllerRegisterRequest;
use App\Http\Requests\AuthControllerLoginRequest;

class AuthController extends Controller
{
    public function guard()
    {
        return Auth::guard();
    }
    
	public function register (AuthControllerRegisterRequest $request) {
		$data = $request->validated();
		$data['role'] = User::ROLE_USER;
		$data['password'] = Hash::make($request->get('password'));
		$user = User::create($data);
        return $this->responseSuccess();
    }
	
	public function login(AuthControllerLoginRequest $request)
    {
        $data = $request->validated();

        if ($token = $this->guard()->attempt($data)) {
            $user = JWTAuth::user();
            return $this->responseSuccess([
                'token'=> $token, 
                'user' => $user
            ]);
        }
        return $this->responseError('Unauthorized', '', 401);
    }

    public function me()
    {
        $user = auth()->user();
        return $this->responseSuccess($user);
    }

    public function logout()
    {
        $this->guard()->logout();

        return $this->responseSuccess();
    }

}
