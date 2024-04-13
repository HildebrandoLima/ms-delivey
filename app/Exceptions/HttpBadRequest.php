<?php

namespace App\Exceptions;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class HttpBadRequest
{
    public static function getResponse(Collection $errors, Collection $details): Response
    {
        return response()->json([
            "message" => DefaultErrorMessages::VALIDATION_FAILURE,
            "data" => $errors,
            "status" => Response::HTTP_BAD_REQUEST,
            "details" => $details,
        ], Response::HTTP_BAD_REQUEST);
    }
}
