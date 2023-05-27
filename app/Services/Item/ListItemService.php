<?php

namespace App\Services\Item;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Services\Item\Interfaces\IListItemService;
use Illuminate\Support\Collection;

class ListItemService implements IListItemService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private ItemRepository $itemRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        ItemRepository           $itemRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->itemRepository          = $itemRepository;
    }

    public function listItemAll(int $id): Collection
    {
        $this->checkRegisterRepository->checkOrderIdExist($id);
        return $this->itemRepository->getAll($id);
    }
}
