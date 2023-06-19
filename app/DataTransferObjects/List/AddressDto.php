<?php

namespace App\DataTransferObjects\List;

class AddressDto
{
    public int $enderecoId;
    public string $logradouro;
    public string $descricao;
    public string $bairro;
    public string $cidade;
    public string $cep;
    public int $ufId;
    public int $usuarioId;
    public int $fornecedorId;
    public bool $ativo;
    public string $criadoEm;
    public string $alteradoEm;

    public function __construct(int $enderecoId, string $logradouro, string $descricao, string $cidade, string $bairro, string $cep, int $ufId, int $usuarioId, int $fornecedorId, bool $ativo, string $criadoEm, string $alteradoEm)
    {
        $this->enderecoId = $enderecoId;
        $this->logradouro = $logradouro;
        $this->descricao = $descricao;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->cep = $cep;
        $this->ufId = $ufId;
        $this->usuarioId = $usuarioId;
        $this->fornecedorId = $fornecedorId;
        $this->ativo = $ativo;
        $this->criadoEm = date('d-m-Y H:i:s', strtotime($criadoEm));
        $this->alteradoEm = date('d-m-Y H:i:s', strtotime($alteradoEm));
    }
}
