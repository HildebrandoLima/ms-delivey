<?php

namespace App\DataTransferObjects\Dtos;

class CategoryDto extends DefaultFields
{
    public int $categoriaId;
    public string $nome;

    public function __construct
    (
        int $categoriaId,
        string $nome,
        string $ativo,
        string $criadoEm,
        string $aleradoEm
    )
    {
        $this->setCategoriaId($categoriaId);
        $this->setNome($nome);
        $this->setAtivo($ativo);
        $this->setCriadoEm($criadoEm);
        $this->setAlteradoEm($aleradoEm);
    }

    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }

    public function setCategoriaId(int $categoriaId): void
    {
        $this->categoriaId = $categoriaId;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }
}
