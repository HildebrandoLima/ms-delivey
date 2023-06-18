<?php

namespace App\DataTransferObjects;

trait DefaultFields
{
    public bool $ativo;
    public string $criadoEm;
    public string $alteradoEm;

    public function __construct(bool $ativo, string $criadoEm, string $alteradoEm)
    {
        $this->ativo = $ativo;
        $this->criadoEm = $criadoEm;
        $this->alteradoEm = $alteradoEm;
    }
}
