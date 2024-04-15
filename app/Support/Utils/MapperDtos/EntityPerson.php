<?php

namespace App\Support\Utils\MapperDtos;

use App\Domains\Dtos\AddressDto;
use App\Domains\Dtos\TelephoneDto;

trait EntityPerson
{
    public function address(array $address): array
    {
        foreach ($address as $key => $instance):
            $address[$key] = $this->mapAddress($instance);
        endforeach;
        return $address;
    }

    private function mapAddress(array $data): AddressDto
    {
        return AutoMapper::map($data, AddressDto::class);
    }

    public function telephone(array $telephones): array
    {
        foreach ($telephones as $key => $instance):
            $telephones[$key] = $this->mapTelephone($instance);
        endforeach;
        return $telephones;
    }

    private function mapTelephone(array $data): TelephoneDto
    {
        return AutoMapper::map($data, TelephoneDto::class);
    }
}
