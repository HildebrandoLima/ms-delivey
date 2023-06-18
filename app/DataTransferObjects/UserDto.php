<?php

namespace App\DataTransferObjects;

use App\MappersDto\AddressMapperDto;
use App\MappersDto\TelephoneMapperDto;
use Illuminate\Database\Eloquent\Collection;

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
    public Collection $perfil;
    public Collection $enderecos;
    public Collection $telefones;

    public function __construct(int $usuarioId, int $providerId, string $provider, string $nome, string $cpf, string $email, string $dataNascimento, string $genero, string $emailVerificado, bool $ativo, string $criadoEm, string $alteradoEm, Collection $perfil, Collection $enderecos, Collection $telefones)
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

    private function addrres(Collection $addrres): Collection
    {
        foreach ($addrres->toArray() as $key => $instance):
            $addrres[$key] = AddressMapperDto::map($instance);
        endforeach;
        return $addrres;
    }

    private function telephone(Collection $telefones): Collection
    {
        foreach ($telefones->toArray() as $key => $instance):
            $telefones[$key] = TelephoneMapperDto::map($instance);
        endforeach;
        return $telefones;
    }
}
