<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\UserDto;

class UserMapperDto
{
    public static function mapper(array $user): UserDto
    {
        return new UserDto
        (
            $user['id'] ?? 0,
            $user['nome'] ?? '',
            $user['cpf'] ?? '',
            $user['email'] ?? '',
            $user['data_nascimento'] ?? '',
            $user['genero'] ?? '',
            $user['email_verified_at'] ?? '',
            $user['is_admin'] ?? 0,
            $user['endereco'] ?? [],
            $user['telefone'] ?? [],
            $user['ativo'] ?? 0,
            $user['created_at'] ?? 0,
            $user['updated_at'] ?? 0,
        );
    }
}
