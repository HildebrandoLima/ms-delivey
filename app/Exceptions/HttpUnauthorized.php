<?php

namespace App\Exceptions;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class HttpUnauthorized
{
    public static function getResponse(Exception $details): Response
    {
        return response()->json([
            "message" => DefaultErrorMessages::UNAUTHORIZED_MESSAGE,
            "data" => [],
            "status" => Response::HTTP_UNAUTHORIZED,
            "details" => $details->getMessage(),
        ], Response::HTTP_UNAUTHORIZED);
    }
}
