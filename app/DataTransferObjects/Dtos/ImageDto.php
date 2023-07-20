<?php

namespace App\DataTransferObjects\Dtos;

class ImageDto extends DefaultFields
{
    public string $caminho;
    public int $produtoId;

    public static function construction(): static
    {
        return new ImageDto();
    }

    public function getCaminho(): string
    {
        return $this->caminho;
    }

    public function setCaminho(string $caminho): ImageDto
    {
        $this->caminho = $caminho;
        return $this;
    }

    public function getProdutoId(): int
    {
        return $this->produtoId;
    }

    public function setProdutoId(int $produtoId): ImageDto
    {
        $this->produtoId = $produtoId;
        return $this;
    }
}
