<?php

namespace App\Services\Auth\Interfaces;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Collection;

interface ILoginService
{
    public function login(LoginRequest $request): Collection;
}
