<?php

namespace App\Services\Auth\Concretes;

use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Auth\Interfaces\RefreshPasswordServiceInterface;

class RefreshPasswordService implements RefreshPasswordServiceInterface
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function refreshPassword(RefreshPasswordRequest $request): bool
    {
        return $this->authRepository->refreshPassword($request);
    }
}
