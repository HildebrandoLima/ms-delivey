<?php

namespace App\Domains\Traits\Dtos;

use App\Domains\Dtos\AddressDto;
use App\Domains\Dtos\TelephoneDto;

trait EntityPerson
{
    use AutoMapper;

    public function address(array $address): array
    {
        foreach ($address as $key => $value) {
            $address[$key] = $this->mapTo($value, AddressDto::class);
        }
        return $address;
    }

    public function telephone(array $telephones): array
    {
        foreach ($telephones as $key => $value) {
            $telephones[$key] = $this->mapTo($value, TelephoneDto::class);
        }
        return $telephones;
    }
}
