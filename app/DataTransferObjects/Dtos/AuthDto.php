<?php

namespace App\DataTransferObjects\Dtos;

class AuthDto
{
    public string $email;
    public string $token;
    public string $codigo;

    public static function construction(): static
    {
        return new AuthDto();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): AuthDto
    {
        $this->email = $email;
        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): AuthDto
    {
        $this->token = $token;
        return $this;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): AuthDto
    {
        $this->codigo = $codigo;
        return $this;
    }
}
