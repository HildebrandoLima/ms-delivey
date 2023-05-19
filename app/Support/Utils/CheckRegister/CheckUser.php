<?php

namespace App\Support\Utils\CheckRegister;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;

class CheckUser
{
    public function checkUserExist(UserRequest $request): void
    {
        if (User::query()->where('name', 'like', $request->nome)
            ->orWhere(function ($query) use ($request) {
                $query->where('cpf', '=', $request->cpf)
                    ->orWhere(function ($query) use ($request) {
                        $query->where('email', 'like', $request->email);
                    });
            })->count() != 0):
            throw new HttpBadRequest('O usuário informado já existe.');
            endif;
    }

    public function checkUserIdExist(int $id): void
    {
        if (User::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O usuário informado não existe.');
        endif;
    }
}
