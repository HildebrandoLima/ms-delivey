<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\ItemDto;

interface ItemRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(ItemDto $itemDto): bool;
}
