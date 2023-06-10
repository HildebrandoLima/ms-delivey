<?php

namespace App\Services\Auth;

use App\Http\Requests\LoginRequest;
use App\Repositories\CheckRegisterRepository;
use App\Services\Auth\Interfaces\ILoginService;
use Illuminate\Support\Collection;

class LoginService implements ILoginService
{
    private CheckRegisterRepository $checkRegisterRepository;

    public function __construct(CheckRegisterRepository $checkRegisterRepository,)
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
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
        $this->checkRegisterRepository->checkFirstAccess($email);
    }
}
