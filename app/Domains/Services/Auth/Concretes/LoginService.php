<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Abstracts\IAuthRepository;
use App\Http\Requests\Auth\LoginRequest;
use App\Domains\Services\Auth\Abstracts\ILoginService;
use App\Exceptions\HttpBadRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;

class LoginService implements ILoginService
{
    private IAuthRepository $authRepository;

    public function __construct(IAuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request): Collection
    {
        $auth = $this->authRepository->login($request);
        if ($auth->isEmpty()):
            throw new HttpResponseException(HttpBadRequest::getResponse(
                collect(),
                collect([
                    'Não foi possível gerar seu token de acesso. Verifique novamente seus dados enviados.'
                ]))
            );
        else:
            return $auth;
        endif;
    }
}
