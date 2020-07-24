<?php

namespace App\Http\Controllers\Api;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class AuthController extends Controller
{
    //
	public function register (Request $request) {
		$validator = Validator::make($request->all(),[]);

		if ($validator->fails())
		{
			return response(['status'=>422,'errors'=>$validator->errors()->all()], 422);
		}
		$data = $request->all();
		$data['Role']=2;
		$data['Active']=0;
		$data['password'] = Hash::make($request->get('password'));
		$user = User::create($data);

		//$token = $user->createToken('Laravel Password Grant Client')->accessToken;
		$response = ['status'=>200,'id'=>$user->id];

		return response()->json($response);
	}
	
	
	public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            $user = JWTAuth::user();
            return $this->respondWithToken(['token'=> $token, 'user' => $user, 'id' => $user->id]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
    public function get_info($id) {
		$return = [];
		$user = User::where('id', $id)->get();
		 return response()->json(['code' => 200, 'data' => ['user' => $user]]);
	}
}
