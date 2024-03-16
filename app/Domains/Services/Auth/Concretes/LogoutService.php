<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Domains\Services\Auth\Abstracts\ILogoutService;
use App\Exceptions\BaseResponseError;
use Illuminate\Http\Exceptions\HttpResponseException;

class LogoutService implements ILogoutService
{
    public function logout(): bool
    {
        if (auth()->check()):
            auth()->logout();
        return true;
        else:
            throw new HttpResponseException(BaseResponseError::httpBadRequest(collect(), collect()));
        endif;
    }
}
