<?php

namespace App\Support\MapperEntity;

use App\DataTransferObjects\MappersDtos\AddressMapperDto;
use App\DataTransferObjects\MappersDtos\RoleMapperDto;
use App\DataTransferObjects\MappersDtos\TelephoneMapperDto;

class EntityPerson
{
    public static function addrres(array $addrres): array
    {
        foreach ($addrres as $key => $instance):
            $addrres[$key] = AddressMapperDto::mapper($instance);
        endforeach;
        return $addrres;
    }

    public static function telephone(array $telefones): array
    {
        foreach ($telefones as $key => $instance):
            $telefones[$key] = TelephoneMapperDto::mapper($instance);
        endforeach;
        return $telefones;
    }

    public static function funcao(array $role): array
    {
        foreach ($role as $key => $instance):
            $role[$key] = RoleMapperDto::mapper($instance);
        endforeach;
        return $role;
    }
}
