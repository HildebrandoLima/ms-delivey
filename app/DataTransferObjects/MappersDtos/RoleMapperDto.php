<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\RoleDto;

class RoleMapperDto
{
    public static function mapper(array $role): RoleDto
    {
        return RoleDto::construction()
        ->setRoleId($role['id'] ?? 0)
        ->setDescricao($role['description'] ?? '')
        ->setCriadoEm($role['created_at'] ?? '')
        ->setAlteradoEm($role['updated_at'] ?? '');
    }
}
