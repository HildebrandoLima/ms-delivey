<?php

namespace App\Services\Auth\Concretes;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\Interfaces\LoginServiceInterface;
use App\Support\Enums\UserEnum;
use Illuminate\Support\Collection;

class LoginService implements LoginServiceInterface
{
    public function login(LoginRequest $request): Collection
    {
        $credentials = $request->only(['email', 'password']);
        return collect([
            'accessToken' => auth()->attempt($credentials),
            'userId' => auth()->user()->id,
            'userName' => auth()->user()->name,
            'userEmail' => auth()->user()->email,
            'isAdmin' => auth()->user()->is_admin == 1 ? UserEnum::E_ADMIN : UserEnum::NAO_E_ADMIN,
            'permissions' => auth()->user()->permissions,
        ]);
    }
}
