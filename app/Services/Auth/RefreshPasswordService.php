<?php

namespace App\Services\Auth;

use App\Http\Requests\RefreshPasswordRequest;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Auth\Interfaces\IRefreshPasswordService;

class RefreshPasswordService implements IRefreshPasswordService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private AuthRepositoryInterface $authRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        AuthRepositoryInterface $authRepositoryInterface,
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->authRepositoryInterface = $authRepositoryInterface;
    }

    public function refreshPassword(RefreshPasswordRequest $request, string $token): bool
    {
        $this->checkRegisterRepository->checkTokenPassword($token);
        $this->checkRegisterRepository->checkUserCodeRefreshPassword($request->codigo);
        return $this->authRepositoryInterface->refreshPassword($request);
    }
}
