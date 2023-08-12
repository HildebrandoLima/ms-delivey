<?php

namespace App\DataTransferObjects\Dtos;

class DefaultFields
{
    public bool $ativo;
    public string $criadoEm;
    public string $alteradoEm;

    public function __construct
    (
        bool $ativo,
        string $criadoEm,
        string $alteradoEm
    )
    {
        $this->setAtivo($ativo);
        $this->setCriadoEm($criadoEm);
        $this->setAlteradoEm($alteradoEm);
    }

    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): void
    {
        $this->ativo = $ativo;
    }

    public function getCriadoEm(): string
    {
        return $this->criadoEm;
    }

    public function setCriadoEm(string $criadoEm): void
    {
        $this->criadoEm = date('d-m-Y H:i:s', strtotime($criadoEm));
    }

    public function getAlteradoEm(): string
    {
        return $this->alteradoEm;
    }

    public function setAlteradoEm(string $alteradoEm): void
    {
        $this->alteradoEm = date('d-m-Y H:i:s', strtotime($alteradoEm));
    }
}
