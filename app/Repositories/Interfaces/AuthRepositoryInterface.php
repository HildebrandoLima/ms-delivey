<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\AuthDto;
use App\Http\Requests\RefreshPasswordRequest;

interface AuthRepositoryInterface
{
    public function create(int $id, int $permission): bool;
    public function forgotPassword(AuthDto $authDto): bool;
    public function refreshPassword(RefreshPasswordRequest $request): bool;
}
