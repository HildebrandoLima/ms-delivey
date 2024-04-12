<?php

namespace App\Exceptions;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class HttpNotFound
{
    public static function getResponse(Exception $details): Response
    {
        return response()->json([
            "message" => DefaultErrorMessages::NOT_FOUND,
            "data" => [],
            "status" => Response::HTTP_NOT_FOUND,
            "details" => $details->getMessage(),
        ], Response::HTTP_NOT_FOUND);
    }
}
