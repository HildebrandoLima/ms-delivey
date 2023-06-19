<?php

namespace App\MappersDto;

use App\DataTransferObjects\List\UserDto;

class UserMapperDto
{
    public static function map(array $user): UserDto
    {
        $userDto = new UserDto
        (
            $user['id'] ?? 0,
            $user['provider_id'] ?? 0,
            $user['provider'] ?? '',
            $user['name'] ?? '',
            $user['cpf'] ?? '',
            $user['email'] ?? '',
            $user['data_nascimento'] ?? '',
            $user['genero'] ?? '',
            $user['email_verified_at'] ?? '',
            $user['ativo'] ?? 0,
            $user['created_at'] ?? '',
            $user['updated_at'] ?? '',
            $user['perfil'] ?? [],
            $user['endereco'] ?? [],
            $user['telefone'] ?? [],
        );
        return $userDto;
    }
}
