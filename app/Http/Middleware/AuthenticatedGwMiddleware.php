<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AuthenticatedGwMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch(\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    "message" => "Token inválido.",
                    "data" => false,
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ]);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    "message" => "Token expirou.",
                    "data" => false,
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ]);
            } else {
                return response()->json([
                    "message" => "Token de autorização não encontrado.",
                    "data" => false,
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ]);
            }
        }
        return $next($request);
    }
}
