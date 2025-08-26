<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
     public function register(Request $request) 
    {
        $validator = Validator::make($request->all(),[
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:225'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required' , 'numeric', 'digits_between:8,15'],
            'gender' => ['required', 'in:male,female,other'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'password' => ['required', 'confirmed',Rules\Password::defaults()],
        ]);
        
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'password' => Hash::make($request->password),
        ]);

        $tokenName = $request->first_name . ' ' . $request->last_name;

        $token = $user->createToken($tokenName);

        return response()->json([
            'user' => $user,
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

         if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ]);
        }

        $user = User::where('email', $request['email'])->firstOrFail();


        $token = $user->createToken($request->email);

        return response()->json([
            'user' => $user,
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request) 
    {
        if($request->user()->tokens()->delete()) {
            return response()->json([
                'message' => 'Logout successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }
}