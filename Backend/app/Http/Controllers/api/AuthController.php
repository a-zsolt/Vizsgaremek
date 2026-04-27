<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginAuthRequest;
use App\Http\Requests\auth\RegisterAuthRequest;
use App\Http\Requests\auth\UpdateAuthRequest;
use App\Models\User;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user account.
     */
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
    /**
     * Authenticate user and return API token with abilities.
     */
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
    /**
     * Revoke current access token and log out user.
     */
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "success" => true,
            "message" => "User logged out successfully",
        ]);
    }
    /**
     * Verify current token and return user with abilities.
     */
    public function check(Request $request){
        return response()->json([
            'valid' => true,
            'user' => $request->user(),
            'abilities' => $request->user()->currentAccessToken()->abilities,
        ]);
    }
    /**
     * Return all users and orders (manager access required).
     */
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
                'config.interiorOptions',
                'config.wheelOption',
                'config.accessories',
            ])->get();

            return response()->json([
                "success" => true,
                "message" => "List all users",
                "users" => $users,
                "orders" => $orders,
                "userCount" => $users->count(),
                "orderCount" => $orders->count(),

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update user data; hash password if provided.
     */
    public function update(UpdateAuthRequest $request, User $user){
        try {
            $data = $request->validated();

            if (empty($data['password'])) {
                unset($data['password']);
            }

            $user->update($data);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200);

    }
}
