<?php

namespace App\DataTransferObjects\Dtos;

class DefaultFields
{
    public bool $ativo;
    public string $criadoEm;
    public string $alteradoEm;

    public static function construction(): static
    {
        return new DefaultFields();
    }

    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): DefaultFields
    {
        $this->ativo = $ativo;
        return $this;
    }

    public function getCriadoEm(): string
    {
        return $this->criadoEm;
    }

    public function setCriadoEm(string $criadoEm): DefaultFields
    {
        $this->criadoEm = date('d-m-Y H:i:s', strtotime($criadoEm));
        return $this;
    }

    public function getAlteradoEm(): string
    {
        return $this->alteradoEm;
    }

    public function setAlteradoEm(string $alteradoEm): DefaultFields
    {
        $this->alteradoEm = date('d-m-Y H:i:s', strtotime($alteradoEm));
        return $this;
    }
}
