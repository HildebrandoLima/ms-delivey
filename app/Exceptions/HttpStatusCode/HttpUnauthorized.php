<?php

namespace App\Exceptions\HttpStatusCode;

use App\Exceptions\SystemDefaultException;
use App\Support\Utils\Messages\DefaultErrorMessages;
use Symfony\Component\HttpFoundation\Response;

class HttpUnauthorized extends SystemDefaultException
{
    function response(): Response
    {
        return response()->json([
            "message" => DefaultErrorMessages::UNAUTHORIZED_MESSAGE,
            "data" => [],
            "status" => Response::HTTP_UNAUTHORIZED,
            "details" => ""
        ], Response::HTTP_UNAUTHORIZED);
    }

    function getLogInfo(): string
    {
        return '';
    }
}
