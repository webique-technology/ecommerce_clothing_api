<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Customer Login
     */
    public function login(LoginRequest $request)
    {
        return $this->authService->customerLogin($request);
    }

    /**
     * Customer Logout
     */
    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

    /**
     * Logged-in Customer Profile
     */
    public function profile(Request $request)
    {
        return $this->authService->profile($request);
    }
}