<?php

namespace App\Services\Auth;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\Interfaces\ILoginService;
use Illuminate\Support\Collection;

class LoginService implements ILoginService
{
    public function login(LoginRequest $request): Collection
    {
        $credentials = $request->only(['email', 'password']);
        return collect([
            'accessToken' => auth()->attempt($credentials),
            'userId' => auth()->user()->id,
            'userName' => auth()->user()->name,
            'userEmail' => auth()->user()->email,
        ]);
    }
}
