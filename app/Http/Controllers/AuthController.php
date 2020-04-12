<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class AuthController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['login','signup']]);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);
        
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'name'=>auth()->user()->name,
            'email'=>auth()->user()->email,
            'user_id'=>auth()->user()->id
        ]);
    }

    public function signup(Request $request){
    	$validatedData = $request->validate([
    		'name'=>'required',
    		'email'=>'required|email|unique:users',
    		'password'=>'required|min:8|confirmed'
    	]);

    	$user = new User();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);
    	$user->save();
    	return $this->login($request);
    }
}
