<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Auth\Interfaces\IAuthResetRepository;
use App\Data\Repositories\Auth\Interfaces\IRefreshPasswordRepository;
use App\Domains\Services\Auth\Interfaces\IRefreshPasswordService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\Auth\RefreshPasswordRequest;

class RefreshPasswordService implements IRefreshPasswordService
{
    use RequestConfigurator;
    private IAuthResetRepository       $authResetRepository;
    private IRefreshPasswordRepository $refreshPasswordRepository;
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

    private function userId(): void
    {
        $this->userId = $this->authResetRepository->readCode($this->request->codigo);
    }

    private function updated(): bool
    {
        return ($this->refreshPasswordRepository->update($this->userId, $this->request->senha) && $this->authResetRepository->delete($this->request->codigo)) ? true : false;
    }
}
