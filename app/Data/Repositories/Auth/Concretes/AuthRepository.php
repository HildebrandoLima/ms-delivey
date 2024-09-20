<?php

namespace App\Data\Repositories\Auth\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Auth\Interfaces\IAuthRepository;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Collection;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class AuthRepository extends DBConnection implements IAuthRepository
{
    public function login(LoginRequest $request): Collection
    {
        try {
            $auth = auth()->attempt($request->only(['email', 'password']));
            if ($auth) {
                $user = auth()->user();
                return collect([
                    'accessToken' => $auth,
                    'userId' => $user->id,
                    'userName' => $user->nome,
                    'userEmail' => $user->email,
                    'role' => $user->role,
                    'permissions' => $user->permissions->map(function ($permission) {
                        return $permission->description;
                    }),
                ]);
            } else {
                return collect([]);
            }

        } catch (Exception $e) {
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }

    public function logout(): bool
    {
        if (auth()->check()) {
            auth()->logout();
        }
        return auth()->check() ? false : true;
    }
}
