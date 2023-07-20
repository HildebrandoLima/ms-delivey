<?php

namespace App\DataTransferObjects\Dtos;

class CategoryDto extends DefaultFields
{
    public int $categoriaId;
    public string $nome;

    public static function construction(): static
    {
        return new CategoryDto();
    }

    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }

    public function setCategoriaId(int $categoriaId): CategoryDto
    {
        $this->categoriaId = $categoriaId;
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
