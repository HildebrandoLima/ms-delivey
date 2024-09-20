<?php

namespace App\Data\Repositories\Order\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Order\Interfaces\IUpdateOrderRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Order\ParamsOrderRequest;
use App\Models\Item;
use App\Models\Pedido;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Exception;

class UpdateOrderRepository extends DBConnection implements IUpdateOrderRepository
{
    use DefaultConditionActive;

    private ParamsOrderRequest $request;
    private Collection $listItems;
    private array $itemsIds;

    public function update(ParamsOrderRequest $request): bool
    {
        try {
            $this->request = $request;
            $this->db->beginTransaction();
            $this->queryItems();
            $this->itemsIds();
            $this->updateItem();
            $result = $this->updateOrder();
            $this->db->commit();
            return $result;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }

    private function queryItems(): void
    {
        $this->listItems = Pedido::with('item')
        ->where('pedido.usuario_id', '=', $this->request->id)
        ->get();
    }

    private function itemsIds(): void
    {
        $this->itemsIds = $this->listItems->flatMap(function ($pedido) {
            return $pedido->item->pluck('id');
        })->unique()->values()->toArray();
    }

    public function updateItem(): void
    {
        Item::query()
        ->whereIn('id', $this->itemsIds)
        ->update([
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }

    public function updateOrder(): bool
    {
        return Pedido::query()
        ->where('id', $this->request->id)
        ->update([
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }
}
