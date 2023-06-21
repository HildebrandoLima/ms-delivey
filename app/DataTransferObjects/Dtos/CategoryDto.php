<?php

namespace App\DataTransferObjects\Dtos;

class CategoryDto extends DefaultFields
{
    public int $categoria_id;
    public string $nome;

    public static function construction(): static
    {
        return new CategoryDto();
    }

    public function getCategoriaId(): int
    {
        return $this->categoria_id;
    }

    public function setCategoriaId(int $categoria_id): CategoryDto
    {
        $this->categoria_id = $categoria_id;
        return $this;
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
