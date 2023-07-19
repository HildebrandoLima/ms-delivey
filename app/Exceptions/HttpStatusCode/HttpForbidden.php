<?php

namespace App\Exceptions\HttpStatusCode;

use App\Exceptions\SystemDefaultException;
use App\Support\Utils\Messages\DefaultErrorMessages;
use Symfony\Component\HttpFoundation\Response;

class HttpForbidden extends SystemDefaultException
{

    function response(): Response
    {
        return response()->json([
            "message" => DefaultErrorMessages::PERMISSION_MESSAGE,
            "data" => [],
            "status" => Response::HTTP_FORBIDDEN,
            "details" => ""
        ], Response::HTTP_FORBIDDEN);
    }

    function getLogInfo(): string
    {
        return '';
    }
}
