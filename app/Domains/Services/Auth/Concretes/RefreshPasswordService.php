<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Auth\Interfaces\IAuthResetRepository;
use App\Data\Repositories\Auth\Interfaces\IRefreshPasswordRepository;
use App\Domains\Services\Auth\Interfaces\IRefreshPasswordService;
use App\Http\Requests\Auth\RefreshPasswordRequest;

class RefreshPasswordService implements IRefreshPasswordService
{
    private IAuthResetRepository       $authResetRepository;
    private IRefreshPasswordRepository $refreshPasswordRepository;
    private RefreshPasswordRequest $request;
    private int $userId = 0;

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
        $this->setRequest($request);
        return $this->updated();
    }

    private function setRequest(RefreshPasswordRequest $request): void
    {
        $this->request = $request;
        $this->userId = $this->authResetRepository->readCode($request->codigo);
    }

    private function updated(): bool
    {
        return ($this->refreshPasswordRepository->update($this->userId, $this->request->senha) && $this->authResetRepository->delete($this->request->codigo)) ? true : false;
    }
}
