<?php

namespace App\DataTransferObjects\Dtos;

class ImageDto extends DefaultFields
{
    public string $caminho;
    public int $produtoId;

    public function __construct
    (
        string $caminho,
        int $produtoId,
        string $ativo,
        string $criadoEm,
        string $aleradoEm
    )
    {
        $this->setCaminho($caminho);
        $this->setProdutoId($produtoId);
        $this->setAtivo($ativo);
        $this->setCriadoEm($criadoEm);
        $this->setAlteradoEm($aleradoEm);
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
