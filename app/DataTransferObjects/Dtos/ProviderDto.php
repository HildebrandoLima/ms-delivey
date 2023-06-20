<?php

namespace App\DataTransferObjects\Dtos;

use App\DataTransferObjects\MappersDtos\AddressMapperDto;
use App\DataTransferObjects\MappersDtos\TelephoneMapperDto;

class ProviderDto extends DefaultFields
{
    public int $fornecedorId;
    public string $razao_social;
    public string $cnpj;
    public string $email;
    public string $data_fundacao;
    public string $emailVerificado;
    public array $enderecos;
    public array $telefones;

    public static function construction(): static
    {
        return new ProviderDto();
    }

    public function getFornecedorId(): int
    {
        return $this->fornecedorId;
    }

    public function setFornecedorId(int $fornecedorId): ProviderDto
    {
        $this->fornecedorId = $fornecedorId;
        return $this;
    }

    public function getRazaoSocial(): string
    {
        return $this->razao_social;
    }

    public function setRazaoSocial(string $razao_social): ProviderDto
    {
        $this->razao_social = $razao_social;
        return $this;
    }

    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): ProviderDto
    {
        $this->cnpj = str_replace(array('.','-','/'), "", $cnpj);
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): ProviderDto
    {
        $this->email = $email;
        return $this;
    }

    public function getDataFundacao(): string
    {
        return $this->data_fundacao;
    }

    public function setDataFundacao(string $data_fundacao): ProviderDto
    {
        $this->data_fundacao = $data_fundacao;
        return $this;
    }

    public function getEmailVerificado(): string
    {
        return $this->emailVerificado;
    }

    public function setEmailVerificado(string $emailVerificado): ProviderDto
    {
        $this->emailVerificado = $emailVerificado;
        return $this;
    }

    public function getEnderecos(): array
    {
        return $this->enderecos;
    }

    public function setEnderecos(array $enderecos): ProviderDto
    {
        $this->enderecos = $this->addrres($enderecos);
        return $this;
    }

    public function getTelefones(): array
    {
        return $this->telefones;
    }

    public function setTelefones(array $telefones): ProviderDto
    {
        $this->telefones = $this->telephone($telefones);
        return $this;
    }

    private function addrres(array $addrres): array
    {
        foreach ($addrres as $key => $instance):
            $addrres[$key] = AddressMapperDto::mapper($instance);
        endforeach;
        return $addrres;
    }

    private function telephone(array $telefones): array
    {
        foreach ($telefones as $key => $instance):
            $telefones[$key] = TelephoneMapperDto::mapper($instance);
        endforeach;
        return $telefones;
    }
}
