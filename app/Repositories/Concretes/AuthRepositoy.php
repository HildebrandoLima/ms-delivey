<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\Dtos\AuthDto;
use App\Http\Requests\RefreshPasswordRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthRepositoy implements AuthRepositoryInterface
{
    public function forgotPassword(AuthDto $authDto): bool
    {
        return PasswordReset::query()->insert((array)$authDto);
    }

    public function refreshPassword(RefreshPasswordRequest $request): bool
    {
        User::query()->where('id', '=', $this->getUserId($request->codigo))
        ->update(['password' => Hash::make($request->senha)]);
        return $this->deletePasswordReset($request->codigo);
    }

    private function getUserId(string $codigo): int
    {
        return User::query()
        ->join('password_resets as pr', 'pr.email', '=', 'users.email')
        ->select('users.id')->where('pr.codigo', $codigo)
        ->get()->toArray()[0]['id'];
    }

    private function deletePasswordReset(string $codigo): bool
    {
        return PasswordReset::query()->where('codigo', '=', $codigo)->delete();
    }
}
