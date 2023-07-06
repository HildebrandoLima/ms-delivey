<?php

namespace App\Exceptions\HttpStatusCode;

use App\Exceptions\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;

class HttpBadRequest extends SystemDefaultException
{
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    function response(): Response
    {
        return response()->json([
            "message" => $this->message,
            "data" => [],
            "status" => Response::HTTP_BAD_REQUEST,
            "details" => ""
        ]);
    }

    function getLogInfo(): string
    {
        return '';
    }
}
