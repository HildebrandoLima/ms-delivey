<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\ICreateUserRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Support\Enums\RoleEnum;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateUserRepository implements ICreateUserRepository
{
    use DefaultConditionActive;

    public function create(CreateUserRequest $request): int
    {
        try {
            DB::beginTransaction();
            $userId = User::query()
            ->create([
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'email' => $request->email,
                'password' => Hash::make($request->senha),
                'data_nascimento' => $request->dataNascimento,
                'genero' => $request->genero,
                'role_id' => $request->perfil === 1 ? RoleEnum::ADMIN : RoleEnum::CLIENTE,
                'ativo' => $this->defaultConditionActive(true)
            ]);
            DB::commit();
            return $userId->id;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
