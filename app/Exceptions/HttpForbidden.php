<?php

namespace App\Exceptions;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Symfony\Component\HttpFoundation\Response;

class HttpForbidden
{
    public static function getResponse(string $details): Response
    {
        return response()->json([
            "message" => DefaultErrorMessages::PERMISSION_MESSAGE,
            "data" => [],
            "status" => Response::HTTP_FORBIDDEN,
            "details" =>  $details,
        ], Response::HTTP_FORBIDDEN);
    }
}
