<?php

namespace App\Repositories;

use App\Http\Requests\RefreshPasswordRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Repositories\Interfaces\IAuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthRepositoy implements IAuthRepository {
    public function forgotPassword(PasswordReset $passwordReset): bool
    {
        return PasswordReset::query()->insert($passwordReset->toArray());
    }

    public function refreshPassword(RefreshPasswordRequest $request): bool
    {
        $user = User::query()->where('id', $this->getUserId($request->codigo))
        ->update(['password' => Hash::make($request->senha)]);
        $password = PasswordReset::query()->where('codigo', $request->codigo)->delete();
        if ($user and $password) return true;
        return false;
    }

    private function getUserId(string $codigo): int
    {
        return User::query()
        ->join('password_resets as pr', 'pr.email', '=', 'users.email')
        ->select('users.id')->where('pr.codigo', $codigo)
        ->get()->toArray()[0]['id'];
    }
}
