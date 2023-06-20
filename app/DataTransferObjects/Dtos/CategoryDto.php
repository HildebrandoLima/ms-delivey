<?php

namespace App\DataTransferObjects\Dtos;

class CategoryDto extends DefaultFields
{
    public string $nome;

    public static function construction(): static
    {
        return new CategoryDto();
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): CategoryDto
    {
        $this->nome = $nome;
        return $this;
    }
}
