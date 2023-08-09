<?php

namespace App\Services\Auth\Concretes;

use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Auth\Interfaces\RefreshPasswordServiceInterface;

class RefreshPasswordService implements RefreshPasswordServiceInterface
{
    private IEntityRepository $authRepository;

    public function __construct(IEntityRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function refreshPassword(RefreshPasswordRequest $request): bool
    {
        $user = $this->map($request);
        if ($this->authRepository->update($user) and $this->deletePasswordReset($request->codigo)):
            return true;
        else:
            return false;
        endif;
    }

    private function checkUser(string $codigo): int
    {
        return User::query()
        ->join('password_resets as pr', 'pr.email', '=', 'users.email')
        ->select('users.id')->where('pr.codigo', '=', $codigo)->get()->toArray()[0]['id'];
    }

    private function map(RefreshPasswordRequest $request): User
    {
        $user = new User();
        $user->id = $this->checkUser($request->codigo);
        $user->password = $request->senha;
        return $user;
    }

    private function deletePasswordReset(string $codigo): bool
    {
        return PasswordReset::query()->where('codigo', '=', $codigo)->delete();
    }
}
