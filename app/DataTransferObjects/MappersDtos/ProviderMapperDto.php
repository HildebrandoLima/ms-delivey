<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\ProviderDto;

class ProviderMapperDto
{
    public static function mapper(array $provider): ProviderDto
    {
        return ProviderDto::construction()
        ->setFornecedorId($provider['id'] ?? 0)
        ->setRazaoSocial($provider['razaoSocial'] ?? '')
        ->setCnpj($provider['cnpj'] ?? '')
        ->setEmail($provider['email'] ?? '')
        ->setEnderecos($provider['endereco'] ?? [])
        ->setTelefones($provider['telefone'] ?? [])
        ->setAtivo($provider['ativo'] ?? 0)
        ->setCriadoEm($provider['created_at'] ?? '')
        ->setAlteradoEm($provider['updated_at'] ?? '');
    }
}
