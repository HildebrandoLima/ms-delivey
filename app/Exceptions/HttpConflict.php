<?php

namespace App\Exceptions;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class HttpConflict
{
    public static function getResponse(Collection $errors, Collection $details): Response
    {
        return response()->json([
            "message" => DefaultErrorMessages::ALREADY_EXISTING,
            "data" => $errors,
            "status" => Response::HTTP_CONFLICT,
            "details" => $details,
        ], Response::HTTP_CONFLICT);
    }
}
