<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginAuthRequest;
use App\Http\Requests\auth\RegisterAuthRequest;
use App\Models\User;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterAuthRequest $request){

        $user = User::create([
            "name" => $request->validated(["name"]),
            "email" => $request->validated(["email"]),
            "password" => Hash::make($request->validated(["password"])),
            "role" => $request->validated(["role"]) ?? 'user'
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

        $token = $user->createToken('auth_token', $abilities)->plainTextToken;

        return response()->json([
            "success" => true,
            "message" => "User logged in successfully",
            "user" => $user,
            "abilities" => $abilities,
            "token" => $token,
        ]);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "success" => true,
            "message" => "User logged out successfully",
        ]);
    }
    public function check(Request $request){
        return response()->json([
            'valid' => true,
            'user' => $request->user(),
            'abilities' => $request->user()->currentAccessToken()->abilities,
        ]);
    }
    public function allData()
    {
        if (!Auth::user()->tokenCan('manager')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Manager access required.',
            ], 403);
        }
        try {

            $users = User::all();
            $orders = Orders::with([
                'user',
                'config',
                'config.carModel',
                'config.colorOption',
                'config.interiorOption',
                'config.wheelOption',
                'config.accessory',
            ])->get();

            return response()->json([
                "success" => true,
                "message" => "List all users",
                "users" => $users,
                "orders" => $orders,
                "userCount" => $users->count(),
                "orderCount" => $orders->count(),

            ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
