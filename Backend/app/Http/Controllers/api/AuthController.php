<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginAuthRequest;
use App\Http\Requests\auth\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterAuthRequest $request){

        $user = User::create([
            "name" => $request->validated(["name"]),
            "email" => $request->validated(["email"]),
            "password" => Hash::make($request->validated(["password"])),
        ]);
        return response()->json([
            "success" => true,
            "message" => "User created successfully",
            "user" => $user
        ], 201);
    }
    public function login(LoginAuthRequest $request){
        if (!Auth::attempt($request->validated())){
            throw ValidationException::withMessages([
                'email' => ['incorrect'],
            ]);
        }

        $user = Auth::user();

        $abilities = ['user'];
        if ($user->role == 'admin'){
            $abilities = ['user', 'manager', 'admin'];
        } else if ($user->role == 'manager'){
            $abilities = ['user', 'manager'];
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "success" => true,
            "message" => "User logged in successfully",
            "abilities" => $abilities,
            "token" => $token,
        ]);
    }
    public function logout(Request $request){
        $request->user()->currentAccesToken()->delete();

        return response()->json([
            "success" => true,
            "message" => "User logged out successfully",
        ]);
    }
    public function me(Request $request){
        return response()->json([
            "success" => true,
            "message" => "User logged in successfully",
            "user" => $request->user()
        ], 200);
    }
}
