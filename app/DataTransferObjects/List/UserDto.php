<?php

namespace App\DataTransferObjects\List;

use App\MappersDto\AddressMapperDto;
use App\MappersDto\TelephoneMapperDto;

class UserDto
{
    public int $usuarioId;
    public int $providerId;
    public string $provider;
    public string $nome;
    public string $cpf;
    public string $email;
    public string $dataNascimento;
    public string $genero;
    public string $emailVerificado;
    public bool $ativo;
    public string $criadoEm;
    public string $alteradoEm;
    public array $perfil;
    public array $enderecos;
    public array $telefones;

    public function __construct(int $usuarioId, int $providerId, string $provider, string $nome, string $cpf, string $email, string $dataNascimento, string $genero, string $emailVerificado, bool $ativo, string $criadoEm, string $alteradoEm, array $perfil, array $enderecos, array $telefones)
    {
        $this->usuarioId = $usuarioId;
        $this->providerId = $providerId;
        $this->provider = $provider;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->dataNascimento = $dataNascimento;
        $this->genero = $genero;
        $this->emailVerificado = $emailVerificado;
        $this->ativo = $ativo;
        $this->criadoEm = date('d-m-Y H:i:s', strtotime($criadoEm));
        $this->alteradoEm = date('d-m-Y H:i:s', strtotime($alteradoEm));
        $this->perfil = $perfil;
        $this->enderecos = $this->addrres($enderecos);
        $this->telefones = $this->telephone($telefones);
    }

    private function addrres(array $addrres): array
    {
        foreach ($addrres as $key => $instance):
            $addrres[$key] = AddressMapperDto::map($instance);
        endforeach;
        return $addrres;
    }

    private function telephone(array $telefones): array
    {
        foreach ($telefones as $key => $instance):
            $telefones[$key] = TelephoneMapperDto::map($instance);
        endforeach;
        return $telefones;
    }
}
