<?php

namespace App\DataTransferObjects\List;

class TelephoneDto
{
    public int $telefoneId;
    public string $numero;
    public string $tipo;
    public int $dddId;
    public int $usuarioId;
    public int $fornecedorId;
    public bool $ativo;
    public string $criadoEm;
    public string $alteradoEm;

    public function __construct(int $telefoneId, string $numero, string $tipo, int $dddId, int $usuarioId, int $fornecedorId, bool $ativo, string $criadoEm, string $alteradoEm)
    {
        $this->telefoneId = $telefoneId;
        $this->numero = $numero;
        $this->tipo = $tipo;
        $this->dddId = $dddId;
        $this->usuarioId = $usuarioId;
        $this->fornecedorId = $fornecedorId;
        $this->ativo = $ativo;
        $this->criadoEm = date('d-m-Y H:i:s', strtotime($criadoEm));
        $this->alteradoEm = date('d-m-Y H:i:s', strtotime($alteradoEm));
    }
}
