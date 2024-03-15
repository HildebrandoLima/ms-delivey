<?php

namespace App\Http\Middleware;

use App\Exceptions\BaseResponseError;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            throw new HttpResponseException(BaseResponseError::httpUnauthorized($e));
        else:
            throw new HttpResponseException(BaseResponseError::httpInternalServerErrorException($e));
        endif;
    }
}
