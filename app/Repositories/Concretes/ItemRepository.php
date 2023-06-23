<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\Dtos\ItemDto;
use App\Models\Item;
use App\Repositories\Interfaces\ItemRepositoryInterface;

class ItemRepository implements ItemRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Item::query()->where('pedido_id', $id)->update(['ativo' => $active]);
    }

    public function create(ItemDto $itemDto): bool
    {
        Item::query()->create((array)$itemDto);
        return true;
    }
}
