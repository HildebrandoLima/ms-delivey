<?php

namespace App\Services\Auth;

use App\Http\Requests\RefreshPasswordRequest;
use App\Repositories\AuthRepositoy;
use App\Repositories\CheckRegisterRepository;
use App\Services\Auth\Interfaces\IRefreshPasswordService;

class RefreshPasswordService implements IRefreshPasswordService
{
    private AuthRepositoy $authRepositoy;
    private CheckRegisterRepository $checkRegisterRepository;

    public function __construct
    (
        AuthRepositoy           $authRepositoy,
        CheckRegisterRepository $checkRegisterRepository
    )
    {
        $this->authRepositoy           = $authRepositoy;
        $this->checkRegisterRepository = $checkRegisterRepository;
    }

    public function refreshPassword(RefreshPasswordRequest $request, string $token): bool
    {
        $this->checkRegisterRepository->checkTokenPassword($token);
        $this->checkRegisterRepository->checkUserCodeRefreshPassword($request->codigo);
        return $this->authRepositoy->refreshPassword($request);
    }
}
