<?php

namespace App\Data\Repositories\Abstracts;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Collection;

interface IAuthRepository
{
    public function login(LoginRequest $request): Collection;
    public function logout(): bool;
    public function readCode(string $codigo): int;
    public function delete(string $codigo): bool;
}
