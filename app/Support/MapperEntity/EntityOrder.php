<?php

namespace App\Support\MapperEntity;

use App\DataTransferObjects\MappersDtos\ItemMapperDto;
use App\DataTransferObjects\MappersDtos\PaymentMapperDto;

class EntityOrder
{
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
