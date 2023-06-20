<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\UserDto;
use App\Http\Requests\UserRequest;

class UserRequestDto
{
    public static function fromRquest(UserRequest $request): UserDto
    {
        $userDto = new UserDto();
        $userDto->setNome($request['nome']);
        $userDto->setCpf($request['cpf']);
        $userDto->setEmail($request['email']);
        $userDto->setSenha($request['senha']);
        $userDto->setDataNascimento($request['dataNascimento']);
        $userDto->setGenero($request['genero']);
        $userDto->setPerfilId($request['perfilId']);
        $userDto->setAtivo($request['ativo']);
        return $userDto;
    }
}
