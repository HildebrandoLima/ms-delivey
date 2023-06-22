<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\UserDto;
use App\Support\Utils\Cases\UserCase;
use Illuminate\Support\Facades\Hash;

class UserRequestDto
{
    public static function fromRquest(array $user): UserDto
    {
        $userDto = new UserDto();
        $gender = new UserCase();
        $userDto->setLoginSocialId($user['loginSocialId'] ?? null);
        $userDto->setLoginSocial($user['loginSocial'] ?? null);
        $userDto->setNome($user['nome']);
        $userDto->setCpf(str_replace(array('.','-','/'), "", $user['cpf']) ?? null);
        $userDto->setEmail($user['email']);
        $userDto->setSenha(Hash::make($user['senha']) ?? null);
        $userDto->setDataNascimento($user['dataNascimento'] ?? null);
        $userDto->setGenero($gender->genderCase($user['genero']));
        $userDto->setPerfilId($user['perfilId']);
        $userDto->setAtivo($user['ativo']);
        return $userDto;
    }
}