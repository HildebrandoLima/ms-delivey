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
    public function login(LoginRequest $request): ?Collection
    {
        try {
            $authToken = $this->attemptLogin($request->only(['email', 'password']));
            return $authToken ? $this->createDataResponse($authToken) : collect([]);
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

    private function attemptLogin(array $credentials): ?string
    {
        return auth()->attempt($credentials);
    }

    private function createDataResponse(string $authToken): Collection
    {
        $user = auth()->user();

        return collect([
            'accessToken' => $authToken,
            'userId' => $user->id,
            'userName' => $user->nome,
            'userEmail' => $user->email,
            'role' => $user->role,
            'permissions' => $user->permissions->pluck('description')
        ]);
    }
}
