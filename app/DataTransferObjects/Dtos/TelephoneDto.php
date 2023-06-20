<?php

namespace App\DataTransferObjects\Dtos;

class TelephoneDto extends DefaultFields
{
    public int $telefoneId;
    public string $numero;
    public string $tipo;
    public int $ddd_id;
    public int|null $usuario_id;
    public int|null $fornecedor_id;

    public static function construction(): static
    {
        return new TelephoneDto();
    }

    public function getTelefoneId(): int
    {
        return $this->telefoneId;
    }

    public function setTelefoneId(int $telefoneId): TelephoneDto
    {
        $this->telefoneId = $telefoneId;
        return $this;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): TelephoneDto
    {
        $this->numero = str_replace('-', "", $numero);
        return $this;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): TelephoneDto
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function getDddId(): int
    {
        return $this->ddd_id;
    }

    public function setDddId(int $ddd_id): TelephoneDto
    {
        $this->ddd_id = $ddd_id;
        return $this;
    }

    public function getUsuarioId(): int|null
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(int|null $usuario_id): TelephoneDto
    {
        $this->usuario_id = $usuario_id;
        return $this;
    }

    public function getFornecedorId(): int|null
    {
        return $this->fornecedor_id;
    }

    public function setFornecedorId(int|null $fornecedor_id): TelephoneDto
    {
        $this->fornecedor_id = $fornecedor_id;
        return $this;
    }
}
