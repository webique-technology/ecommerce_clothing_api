<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use App\Http\Requests\Admin\Auth\LoginRequest;

class AuthService
{
    /**
     * Admin Login
     */
    public function adminLogin(Request  $request)
    {
        $user = User::with('role', 'section')
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        if (!$user->status) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is inactive.',
            ], 403);
        }

        // Only Admin can login here
        if ($user->role->slug !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to login here.',
            ], 403);
        }

        $token = $user->createToken(config('app.name'))->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role->slug,
                    'section' => $user->section?->slug,
                ],
            ],
        ], 200);
    }

    /**
     * Customer Login
     */
    public function customerLogin(Request $request)
    {
        $user = User::with('role', 'section')
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        if (!$user->status) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is inactive.',
            ], 403);
        }

        // Only Customer can login here
        if ($user->role->slug !== 'customer') {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to login here.',
            ], 403);
        }

        $token = $user->createToken(config('app.name'))->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role->slug,
                    'section' => null,
                ],
            ],
        ], 200);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful.',
        ], 200);
    }

    /**
     * Logged-in User Profile
     */
    public function profile(Request $request)
    {
        $user = $request->user()->load('role', 'section');

        return response()->json([
            'success' => true,
            'message' => 'Profile fetched successfully.',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role->slug,
                    'section' => $user->section?->slug,
                ],
            ],
        ], 200);
    }
}