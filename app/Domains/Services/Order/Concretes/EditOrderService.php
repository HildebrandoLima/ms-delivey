<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Order\Abstracts\IEditOrderService;
use App\Http\Requests\Order\ParamsOrderRequest;
use App\Models\Item;
use App\Models\Pedido;
use App\Support\Enums\ActiveEnum;

class EditOrderService implements IEditOrderService
{
    private IEntityRepository $orderRepository;

    public function __construct(IEntityRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function editOrder(ParamsOrderRequest $request): bool
    {
        $listItems = $this->orderRepository->read((new Item()), $request->id);

        foreach ($listItems as $instance):
            $item = $this->mapItem($instance->itemId, $request->ativo);
            $this->orderRepository->update($item);
        endforeach;

        $order = $this->mapOrder($request);
        return $this->orderRepository->update($order);
    }

    public function mapItem(int $id, bool $ativo): Item
    {
        $item = new Item();
        $item->id = $id;
        $item->ativo = $ativo == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO;
        return $item;
    }

    public function mapOrder(ParamsOrderRequest $request): Pedido
    {
        $order = new Pedido();
        $order->id = $request->id;
        $order->ativo = $request->ativo == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO;
        return $order;
    }
}
