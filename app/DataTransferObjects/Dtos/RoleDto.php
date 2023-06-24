<?php

namespace App\DataTransferObjects\Dtos;

class RoleDto extends DefaultFields
{
    public int $role_id;
    public string $descricao;

    public static function construction(): static
    {
        return new RoleDto();
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }

    public function setRoleId(int $role_id): RoleDto
    {
        $this->role_id = $role_id;
        return $this;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): RoleDto
    {
        $this->descricao = $descricao;
        return $this;
    }
}
