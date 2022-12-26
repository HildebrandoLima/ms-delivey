<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

abstract class SystemDefaultException extends Exception
{
    abstract function response(): Response;
    abstract function getLogInfo(): string;
}
