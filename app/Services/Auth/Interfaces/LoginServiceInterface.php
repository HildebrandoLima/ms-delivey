<?php

namespace App\Services\Auth\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Collection;

interface LoginServiceInterface
{
    public function login(LoginRequest $request): Collection;
}
