<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $user_store = new User();
            $request->validate([
                'name' => 'required|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8'
            ], [], [
                'name.unique' => 'Role name already exists ',
                'email.unique' => 'Email already exists',
                'password.min' => 'Password must be at least 8 characters'
            ]);
            $user_datatime = Carbon::now();
            $payloads_user = $user_store->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_at' => $user_datatime
            ]);
            if ($request->role_id) {
                $payloads_user->roles()->syncWithoutDetaching([$request->role_id]);
            }
            return response()->json([
                'message' => 'Regiser Successfully',
                'payloads' => $payloads_user
            ], 200);
        }
        catch (\Exception $e) {
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Wrong password'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user->load('roles')->makeHidden(['password'])
        ], 200);
    }
}