<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\UserDto;
use App\Support\Utils\Cases\UserCase;

class UserEditRequestDto
{
    public static function fromRquest(array $user): UserDto
    {
        $userDto = new UserDto();
        $gender = new UserCase();
        $userDto->setNome($user['nome']);
        $userDto->setEmail($user['email']);
        $userDto->setGenero($gender->genderCase($user['genero']));
        $userDto->setIsAdmin($user['perfil']);
        return $userDto;
    }
}
