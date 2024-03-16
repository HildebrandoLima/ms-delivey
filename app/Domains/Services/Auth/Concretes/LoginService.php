<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Exceptions\BaseResponseError;
use App\Http\Requests\Auth\LoginRequest;
use App\Domains\Services\Auth\Abstracts\ILoginService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;

class LoginService implements ILoginService
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
                'isAdmin' => $user->e_admin == 1 ? (bool)PerfilEnum::ADMIN : (bool)PerfilEnum::CLIENTE,
                'permissions' => $user->permissions,
            ]);
        else:
            throw new HttpResponseException(BaseResponseError::httpBadRequest(collect(), collect()));
        endif;
    }
}
