<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Auth\Interfaces\IAuthResetRepository;
use App\Data\Repositories\Auth\Interfaces\IRefreshPasswordRepository;
use App\Domains\Services\Auth\Abstracts\IRefreshPasswordService;
use App\Http\Requests\Auth\RefreshPasswordRequest;

class RefreshPasswordService implements IRefreshPasswordService
{
    private IAuthResetRepository       $authResetRepository;
    private IRefreshPasswordRepository $refreshPasswordRepository;

    public function __construct
    (
        IAuthResetRepository          $authResetRepository,
        IRefreshPasswordRepository    $refreshPasswordRepository
    )
    {
        $this->authResetRepository       = $authResetRepository;
        $this->refreshPasswordRepository = $refreshPasswordRepository;
    }

    public function refreshPassword(RefreshPasswordRequest $request): bool
    {
        $userId = $this->authResetRepository->readCode($request->codigo);
        return ($this->refreshPasswordRepository->update($userId, $request->senha) && $this->authResetRepository->delete($request->codigo)) ? true : false;
    }
}
