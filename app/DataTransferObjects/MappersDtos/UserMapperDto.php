<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\UserDto;

class UserMapperDto
{
    public static function mapper(array $user): UserDto
    {
        return UserDto::construction()
        ->setUsuarioId($user['id'] ?? 0)
        ->setLoginSocialId($user['provider_id'] ?? 0)
        ->setLoginSocial($user['provider'] ?? '')
        ->setNome($user['name'] ?? '')
        ->setCpf($user['cpf'] ?? '')
        ->setEmail($user['email'] ?? '')
        ->setDataNascimento($user['data_nascimento'] ?? '')
        ->setGenero($user['genero'] ?? '')
        ->setEmailVerificado($user['email_verified_at'] ?? '')
        ->setRole($user['role'] ?? [])
        ->setEnderecos($user['endereco'] ?? [])
        ->setTelefones($user['telefone'] ?? [])
        ->setAtivo($user['ativo'] ?? 0)
        ->setCriadoEm($user['created_at'] ?? 0)
        ->setAlteradoEm($user['updated_at'] ?? 0);
    }
}
