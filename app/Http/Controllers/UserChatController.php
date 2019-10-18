<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserChatController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    protected function respondWithToken($token, $id)
    {
    return response()->json([
        'access_token'  => $token,
        'token_type'    => 'bearer',
        'expires_in'    => auth('api')->factory()->getTTL() * 60,
        'detail_user'   => $id
    ]);
    }

    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required|string|max:255',
        //     'phone' => 'required|string|max:14',
        //     'password' => 'required|string|min:6',
        // ]);

        // if($validator->fails()){
        //     return response()->json($validator->errors()->toJson(), 400);
        // }

        $user = User::create([
            'username'  => $request->input('username'),
            'phone'     => $request->input('phone'),
            'password'  => bcrypt($request->input('password')),
            'photo'     => asset('img/profil.jpg')
        ]);

        $token = auth()->login($user);
        $get = User::where('phone', $request->phone);
        $id = $get->first(); 
        return $this->respondWithToken($token, $id);

        // return response()->json(['send'=> 'data masuk cuk!'],201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    
}
