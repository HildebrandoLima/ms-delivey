<?php

namespace App\DataTransferObjects\Dtos;

class DefaultFields
{
    public bool $ativo;
    public string $criado_em;
    public string $alterado_em;

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
        return $this->criado_em;
    }

    public function setCriadoEm(string $criado_em): DefaultFields
    {
        $this->criado_em = date('d-m-Y H:i:s', strtotime($criado_em));
        return $this;
    }

    public function getAlteradoEm(): string
    {
        return $this->alterado_em;
    }

    public function setAlteradoEm(string $alterado_em): DefaultFields
    {
        $this->alterado_em = date('d-m-Y H:i:s', strtotime($alterado_em));
        return $this;
    }
}
