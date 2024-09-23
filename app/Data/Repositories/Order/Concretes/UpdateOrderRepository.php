<?php

namespace App\Data\Repositories\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IUpdateOrderRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Domains\Traits\RequestConfigurator;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Order\ParamsOrderRequest;
use App\Models\Item;
use App\Models\Pedido;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateOrderRepository implements IUpdateOrderRepository
{
    use DefaultConditionActive, RequestConfigurator;
    private Collection $listItems;
    private array $itemsIds = [];

    public function update(ParamsOrderRequest $request): bool
    {
        try {
            $this->setRequest($request);
            DB::beginTransaction();
            $this->fetchItems();
            $this->updatedItem();
            $this->updatedOrder();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }

    private function fetchItems(): void
    {
        $this->listItems = Pedido::with('item')
        ->where('pedido.usuario_id', '=', $this->request->id)
        ->get();

        $this->itemsIds = $this->listItems->flatMap(function ($pedido) {
            return $pedido->item->pluck('id');
        })->unique()->values()->toArray();
    }

    private function updatedItem(): void
    {
        Item::query()
        ->whereIn('id', $this->itemsIds)
        ->update([
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }

    private function updatedOrder(): void
    {
        Pedido::query()
        ->where('id', $this->request->id)
        ->update([
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }
}
