<?php

namespace App\Http\Middleware;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Exception;

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
        } catch(Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json([
                    "message" => DefaultErrorMessages::UNAUTHORIZED_MESSAGE,
                    "data" => [],
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ], Response::HTTP_UNAUTHORIZED);
            } elseif ($e instanceof TokenExpiredException) {
                return response()->json([
                    "message" => DefaultErrorMessages::UNAUTHORIZED_MESSAGE,
                    "data" => [],
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ], Response::HTTP_UNAUTHORIZED);
            } else {
                return response()->json([
                    "message" => DefaultErrorMessages::UNAUTHORIZED_MESSAGE,
                    "data" => [],
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ], Response::HTTP_UNAUTHORIZED);
            }
        }
        return $next($request);
    }
}
