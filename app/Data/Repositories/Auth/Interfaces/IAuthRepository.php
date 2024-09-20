<?php

namespace App\Data\Repositories\Auth\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Collection;

interface IAuthRepository
{
    public function login(LoginRequest $request): Collection;
    public function logout(): bool;
}
