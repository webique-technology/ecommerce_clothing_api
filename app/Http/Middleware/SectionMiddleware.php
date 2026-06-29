<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SectionMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $section): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated.'
            ], 401);
        }

        if (!$user->section) {
            return response()->json([
                'success' => false,
                'message' => 'No section assigned.'
            ], 403);
        }

        if ($user->section->slug !== $section) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to access this section.'
            ], 403);
        }

        return $next($request);
    }
}