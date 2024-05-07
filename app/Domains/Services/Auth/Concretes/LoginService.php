<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Http\Requests\Auth\LoginRequest;
use App\Domains\Services\Auth\Abstracts\ILoginService;
use App\Exceptions\HttpBadRequest;
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
                'role' => $user->role,
                'permissions' => $user->permissions(),
            ]);
        else:
            throw new HttpResponseException(HttpBadRequest::getResponse(collect(),
            collect([
                'Não foi possível gerar seu token de acesso. Verifique novamente seus dados enviados.'
            ])));
        endif;
    }
}
