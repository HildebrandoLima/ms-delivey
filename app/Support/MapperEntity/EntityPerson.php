<?php

namespace App\Support\MapperEntity;

use App\Dtos\AddressDto;
use App\Dtos\TelephoneDto;
use App\Support\AutoMapper\AutoMapper;

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
        return AutoMapper::map($data, AddressDto::class);
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
        return AutoMapper::map($data, TelephoneDto::class);
    }
}
