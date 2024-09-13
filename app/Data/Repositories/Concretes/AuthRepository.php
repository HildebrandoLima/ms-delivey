<?php

namespace App\Data\Repositories\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Abstracts\IAuthRepository;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Exception;

class AuthRepository extends DBConnection implements IAuthRepository
{
    public function login(LoginRequest $request): Collection
    {
        $auth = auth()->attempt($request->only(['email', 'password']));
        if ($auth):
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
        else:
            return collect([]);
        endif;   
    }

    public function logout(): bool
    {
        if (auth()->check()):
            auth()->logout();
            return true;
        else:
            return false;
        endif;
    }

    public function readCode(string $codigo): int
    {
        return User::query()
        ->join('password_resets as pr', 'pr.email', '=', 'users.email')
        ->select('users.id')->where('pr.codigo', '=', $codigo)->get()->first()->id;
    }

    public function delete(string $codigo): bool
    {
        try {
            $this->db->beginTransaction();
            $id = PasswordReset::query()->where('codigo', '=', $codigo)->delete();
            $this->db->commit();
            return $id;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
