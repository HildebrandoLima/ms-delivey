<?php

namespace App\Services\Auth\Concretes;

use App\Http\Requests\LoginRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Auth\Interfaces\LoginServiceInterface;
use App\Support\Utils\Enums\UserEnum;
use Illuminate\Support\Collection;

class LoginService implements LoginServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;

    public function __construct(CheckEntityRepositoryInterface $checkEntityRepository)
    {
        $this->checkEntityRepository = $checkEntityRepository;
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
            'isAdmin' => auth()->user()->is_admin == 1 ? UserEnum::IS_ADMIN : UserEnum::NOT_IS_ADMIN,
            'permissions' => auth()->user()->permissions,
        ]);
    }

    private function firstAccess(string $email): void
    {
        $this->checkEntityRepository->checkFirstAccess($email);
    }
}
