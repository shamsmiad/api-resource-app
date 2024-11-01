<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){
       $validator = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|alpha_num|min:8'
        ]);
        $validator['password'] = Hash::make($validator['password']);
        User::create($validator);

        return response()->json(['message'=>'User registered successfuly']);
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);
        $credential =$request->only('email','password');
        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        if(Auth::attempt($credential)){
          
            $data = new UserResource(Auth::user());

            // Sanctum will handle the session cookie automatically
    
            return response()->json([
                'message' => 'Login successful.',
                'user' => $data,
            ]);
        }
        // $token = $user->createToken('auth Token')->plainTextToken;
        // $data = new UserResource(Auth::user());
        // return $data;
    }

    public function logout(Request $request)
    {
        auth()->guard('web')->logout();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
