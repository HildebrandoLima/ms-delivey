<?php

namespace App\Support\MapperEntity;

use App\Domains\Dtos\AddressDto;
use App\Domains\Dtos\TelephoneDto;
use App\Support\AutoMapper\AutoMapper;

class EntityPerson
{
    public static function addrres(array $address): array
    {
        foreach ($address as $key => $instance):
            $address[$key] = self::mapAddress($instance);
        endforeach;
        return $address;
    }

    private static function mapAddress(array $data): AddressDto
    {
        return AutoMapper::map($data, AddressDto::class);
    }

    public static function telephone(array $telephones): array
    {
        foreach ($telephones as $key => $instance):
            $telephones[$key] = self::mapTelephone($instance);
        endforeach;
        return $telephones;
    }

    private static function mapTelephone(array $data): TelephoneDto
    {
        return AutoMapper::map($data, TelephoneDto::class);
    }
}
