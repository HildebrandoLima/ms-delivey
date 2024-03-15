<?php

namespace App\Services\Auth\Concretes;

use App\Exceptions\BaseResponseError;
use App\Services\Auth\Abstracts\ILogoutService;
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
