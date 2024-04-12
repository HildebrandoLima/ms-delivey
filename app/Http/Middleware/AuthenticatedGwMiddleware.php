<?php

namespace App\Http\Middleware;

use App\Exceptions\HttpInternalServerError;
use App\Exceptions\HttpUnauthorized;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Closure;
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
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException):
               $this->getResponse($e);
            elseif ($e instanceof TokenExpiredException):
               $this->getResponse($e);
            else:
               $this->getResponse($e);
            endif;
        }
        return $next($request);
    }

    private function getResponse(Exception $e): void
    {
        if ($e instanceof TokenInvalidException || $e instanceof TokenExpiredException):
            throw new HttpResponseException(HttpUnauthorized::getResponse($e));
        else:
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        endif;
    }
}
