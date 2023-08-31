<?php

namespace App\Support\MapperEntity;

use App\Dtos\AddressDto;
use App\Dtos\TelephoneDto;
use App\Support\Utils\DateFormat\DateFormat;

class EntityPerson
{
    public static function addrres(array $addrres): array
    {
        foreach ($addrres as $key => $instance):
            $addrres[$key] = self::mapAddress($instance);
        endforeach;
        return $addrres;
    }

    private static function mapAddress(array $data): AddressDto
    {
        $address = new AddressDto();
        $address->enderecoId = $data['id'];
        $address->logradouro = $data['logradouro'];
        $address->numero = $data['numero'];
        $address->bairro = $data['bairro'];
        $address->cidade = $data['cidade'];
        $address->cep = $data['cep'];
        $address->uf = $data['uf'];
        $address->usuarioId = $data['usuario_id'];
        $address->fornecedorId = $data['fornecedor_id'];
        $address->ativo = $data['ativo'];
        $address->criadoEm = DateFormat::dateFormat($data['created_at']);
        $address->alteradoEm = DateFormat::dateFormat($data['updated_at']);
        return $address;
    }

    public static function telephone(array $telefones): array
    {
        foreach ($telefones as $key => $instance):
            $telefones[$key] = self::mapTelephone($instance);
        endforeach;
        return $telefones;
    }

    private static function mapTelephone(array $data): TelephoneDto
    {
        $telephone = new TelephoneDto();
        $telephone->telefoneId = $data['id'];
        $telephone->numero = $data['numero'];
        $telephone->tipo = $data['tipo'];
        $telephone->usuarioId = $data['usuario_id'];
        $telephone->fornecedorId = $data['fornecedor_id'];
        $telephone->ativo = $data['ativo'];
        $telephone->criadoEm = DateFormat::dateFormat($data['created_at']);
        $telephone->alteradoEm = DateFormat::dateFormat($data['updated_at']);
        return $telephone;
    }
}
