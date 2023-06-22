<?php

namespace App\Support;

use App\DataTransferObjects\MappersDtos\AddressMapperDto;
use App\DataTransferObjects\MappersDtos\ImageMapperDto;
use App\DataTransferObjects\MappersDtos\ItemMapperDto;
use App\DataTransferObjects\MappersDtos\PaymentMapperDto;
use App\DataTransferObjects\MappersDtos\TelephoneMapperDto;

class MapperFunctions
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

    public static function imagens(array $imagens): array
    {
        foreach ($imagens as $key => $instance):
            $imagens[$key] = ImageMapperDto::mapper($instance);
        endforeach;
        return $imagens;
    }

    public static function items(array $items): array
    {
        foreach ($items as $key => $instance):
            $items[$key] = ItemMapperDto::mapper($instance);
        endforeach;
        return $items;
    }

    public static function pagamento(array $pagamento): array
    {
        foreach ($pagamento as $key => $instance):
            $pagamento[$key] = PaymentMapperDto::mapper($instance);
        endforeach;
        return $pagamento;
    }
}
