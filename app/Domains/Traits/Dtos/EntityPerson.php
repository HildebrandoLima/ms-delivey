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
            $address[$key] = $this->mapAddress($value);
        }
        return $address;
    }

    private function mapAddress(array $data): AddressDto
    {
        return $this->mapper($data, AddressDto::class);
    }

    public function telephone(array $telephones): array
    {
        foreach ($telephones as $key => $value) {
            $telephones[$key] = $this->mapTelephone($value);
        }
        return $telephones;
    }

    private function mapTelephone(array $data): TelephoneDto
    {
        return $this->mapper($data, TelephoneDto::class);
    }
}
