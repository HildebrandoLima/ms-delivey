<?php

namespace App\DataTransferObjects\Dtos;

class ImageDto extends DefaultFields
{
    public string $caminho;
    public int $produto_id;

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
        return $this->produto_id;
    }

    public function setProdutoId(int $produto_id): ImageDto
    {
        $this->produto_id = $produto_id;
        return $this;
    }
}
