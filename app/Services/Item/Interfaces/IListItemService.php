<?php

namespace App\Services\Item\Interfaces;

use Illuminate\Support\Collection;

interface IListItemService
{
    public function listItemAll(int $id): Collection;
}
