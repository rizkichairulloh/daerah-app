<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Register Failed!',
                    'data' => $validator->errors(),
                ]
            );
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'Create User Successfully',
            'data' => $success,
        ], 201);
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $authenticated_user = Auth::user();
            $user = User::find($authenticated_user->id);
            $success['token'] = $user->createToken('auth_token')->plainTextToken;
            $success['name'] = $user->name;

            return response()->json([
                'success' => true,
                'message' => 'Login successfully',
                'data' => $success,
            ], 200);
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Login failed',
                    'data' => null,
                ]
            );
        }
    }

    public function logout(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Revoke the user's tokens
            $request->user()->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not authenticated',
        ], 401);
    }
}
