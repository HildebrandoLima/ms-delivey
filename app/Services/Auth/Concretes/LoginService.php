<?php

namespace App\Services\Auth\Concretes;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\Abstracts\ILoginService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Collection;

class LoginService implements ILoginService
{
    public function login(LoginRequest $request): Collection
    {
        return collect([
            'accessToken' => auth()->attempt($request->only(['email', 'password'])),
            'userId' => auth()->user()->id,
            'userName' => auth()->user()->nome,
            'userEmail' => auth()->user()->email,
            'isAdmin' => auth()->user()->is_admin == 1 ? (bool)PerfilEnum::ADMIN : (bool)PerfilEnum::CLIENTE,
            'permissions' => auth()->user()->permissions,
        ]);
    }
}
