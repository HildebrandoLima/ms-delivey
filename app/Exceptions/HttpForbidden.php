<?php

namespace App\Exceptions;

use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\Response;

class HttpForbidden extends SystemDefaultException
{

    /**
     * BadRequestException constructor.
     */
    private mixed $data;
    #[Pure] public function __construct(string $message, mixed $data = '')
    {
        $this->message = $message;
        $this->data = $data;
        parent::__construct($message);
    }

    function response(): Response
    {
        return response()->json([
            "message" => $this->message,
            "data" => $this->data,
            "status" => Response::HTTP_FORBIDDEN,
            "details" => ""
        ]);
    }

    function getLogInfo(): string
    {
        return '';
    }
}
