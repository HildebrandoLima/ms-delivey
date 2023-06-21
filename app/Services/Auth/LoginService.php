<?php

namespace App\Services\Auth;

use App\Http\Requests\LoginRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Auth\Interfaces\ILoginService;
use Illuminate\Support\Collection;

class LoginService implements ILoginService
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;

    public function __construct(CheckEntityRepositoryInterface $checkEntityRepositoryInterface)
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
    }

    public function login(LoginRequest $request): Collection
    {
        $credentials = $request->only(['email', 'password']);
        $this->firstAccess($request->email);
        return collect([
            'accessToken' => auth()->attempt($credentials),
            'userId' => auth()->user()->id,
            'userName' => auth()->user()->name,
            'userEmail' => auth()->user()->email,
            'perfilName' => auth()->user()->perfil->perfil
        ]);
    }

    private function firstAccess(string $email): void
    {
        $this->checkEntityRepositoryInterface->checkFirstAccess($email);
    }
}
