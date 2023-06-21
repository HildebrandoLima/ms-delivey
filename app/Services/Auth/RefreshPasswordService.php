<?php

namespace App\Services\Auth;

use App\Http\Requests\RefreshPasswordRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Auth\Interfaces\IRefreshPasswordService;

class RefreshPasswordService implements IRefreshPasswordService
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private AuthRepositoryInterface        $authRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        AuthRepositoryInterface        $authRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->authRepositoryInterface        = $authRepositoryInterface;
    }

    public function refreshPassword(RefreshPasswordRequest $request, string $token): bool
    {
        $this->checkEntityRepositoryInterface->checkTokenPassword($token);
        $this->checkEntityRepositoryInterface->checkUserCodeRefreshPassword($request->codigo);
        return $this->authRepositoryInterface->refreshPassword($request);
    }
}
