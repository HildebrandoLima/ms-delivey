<?php

namespace App\Exceptions\HttpStatusCode;

use App\Exceptions\SystemDefaultException;
use App\Support\Utils\Messages\DefaultErrorMessages;
use Symfony\Component\HttpFoundation\Response;

class HttpNotFound extends SystemDefaultException
{
    function response(): Response
    {
        return response()->json([
            "message" => DefaultErrorMessages::NOT_FOUND,
            "data" => [],
            "status" => Response::HTTP_NOT_FOUND,
            "details" => ""
        ]);
    }

    function getLogInfo(): string
    {
        return '';
    }
}
