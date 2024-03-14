<?php

namespace App\Exceptions;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class BaseResponseError
{
    public static function httpBadRequest(Collection $errors, Collection $details): Response
    {
        Log::error("Error: [" . $details . "]");
        return response()->json([
            "message" => DefaultErrorMessages::VALIDATION_FAILURE,
            "data" => $errors,
            "status" => Response::HTTP_BAD_REQUEST,
            "details" => $details,
        ], Response::HTTP_BAD_REQUEST);
    }

    public static function httpUnauthorized(TokenInvalidException|TokenExpiredException $details): Response
    {
        Log::error("Error: [" . $details->getMessage() . "]");
        return response()->json([
            "message" => DefaultErrorMessages::UNAUTHORIZED_MESSAGE,
            "data" => [],
            "status" => Response::HTTP_UNAUTHORIZED,
            "details" => $details->getMessage(),
        ], Response::HTTP_UNAUTHORIZED);
    }

    public static function httpForbidden(string $details): Response
    {
        Log::error("Error: [" . $details . "]");
        return response()->json([
            "message" => DefaultErrorMessages::PERMISSION_MESSAGE,
            "data" => [],
            "status" => Response::HTTP_FORBIDDEN,
            "details" =>  $details,
        ], Response::HTTP_FORBIDDEN);
    }

    public static function httpNotFound(NotFoundHttpException $details): Response
    {
        Log::error("Error: [" . $details->getMessage() . "]");
        return response()->json([
            "message" => DefaultErrorMessages::NOT_FOUND,
            "data" => [],
            "status" => Response::HTTP_NOT_FOUND,
            "details" => $details->getMessage(),
        ], Response::HTTP_NOT_FOUND);
    }

    public static function httpInternalServerErrorException(QueryException $details): Response
    {
        Log::error("Error: [" . $details->getMessage() . "]");
        return response()->json([
            "message" => DefaultErrorMessages::DATABASE_QUERY_ERROR,
            "data" => [],
            "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
            "details" => $details->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
