<?php

namespace App\Exceptions;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class HttpNotFound
{
    public static function getResponse(Collection $errors, Collection|string $details): Response
    {
        return response()->json([
            "message" => DefaultErrorMessages::NOT_FOUND,
            "data" => $errors,
            "status" => Response::HTTP_NOT_FOUND,
            "details" => $details,
        ], Response::HTTP_NOT_FOUND);
    }
}
