<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    use ApiResponse;
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(["message" => "Token is Invalid", "status" => 401], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(["message" => "Token is Expired", "status" => 408], 408);
            } else {
                return response()->json(["message" => "Authorization Token not found", "status" => 404], 404);
            }
        }
        return $next($request);
    }
}
