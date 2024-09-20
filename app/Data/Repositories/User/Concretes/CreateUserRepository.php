<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\User\Interfaces\ICreateUserRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Support\Enums\RoleEnum;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Exception;

class CreateUserRepository extends DBConnection implements ICreateUserRepository
{
    use DefaultConditionActive;

    public function create(CreateUserRequest $request): int
    {
        try {
            $this->db->beginTransaction();
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
            ])->orderBy('id', 'desc')->first()->id;
            $this->db->commit();
            return $userId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
