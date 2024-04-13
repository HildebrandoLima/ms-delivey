<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Domains\Services\Auth\Abstracts\ILogoutService;
use App\Exceptions\HttpBadRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LogoutService implements ILogoutService
{
    public function logout(): bool
    {
        if (auth()->check()):
            auth()->logout();
        return true;
        else:
            throw new HttpResponseException(HttpBadRequest::getResponse(collect(),
            collect([
                'Usuário não está logado.'
            ])));
        endif;
    }
}
