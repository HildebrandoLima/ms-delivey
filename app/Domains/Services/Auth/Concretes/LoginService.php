<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Auth\Interfaces\IAuthRepository;
use App\Domains\Services\Auth\Interfaces\ILoginService;
use App\Http\Requests\Auth\LoginRequest;
use App\Exceptions\HttpInternalServerError;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Exception;

class LoginService implements ILoginService
{
    private IAuthRepository $authRepository;

    public function __construct(IAuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request): Collection
    {
        try {
            return $this->authRepository->login($request);
        } catch (Exception $e) {
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
