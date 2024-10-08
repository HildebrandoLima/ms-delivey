<?php

namespace App\Domains\Services\Auth\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Collection;

interface ILoginService
{
    public function login(LoginRequest $request): Collection;
}
