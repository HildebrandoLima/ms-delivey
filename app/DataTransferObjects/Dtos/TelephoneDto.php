<?php

namespace App\DataTransferObjects\Dtos;

class TelephoneDto extends DefaultFields
{
    public int $telefoneId;
    public string $numero;
    public string $tipo;
    public int $dddId;
    public int|null $usuarioId;
    public int|null $fornecedorId;

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
        $this->numero = $numero;
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
        return $this->dddId;
    }

    public function setDddId(int $dddId): TelephoneDto
    {
        $this->dddId = $dddId;
        return $this;
    }

    public function getUsuarioId(): int|null
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(int|null $usuarioId): TelephoneDto
    {
        $this->usuarioId = $usuarioId;
        return $this;
    }

    public function getFornecedorId(): int|null
    {
        return $this->fornecedorId;
    }

    public function setFornecedorId(int|null $fornecedorId): TelephoneDto
    {
        $this->fornecedorId = $fornecedorId;
        return $this;
    }
}
