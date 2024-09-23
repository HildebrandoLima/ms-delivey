<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Domains\Traits\RequestConfigurator;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Endereco;
use App\Models\Item;
use App\Models\Pedido;
use App\Models\Telefone;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateUserRepository implements IUpdateUserRepository
{
    use DefaultConditionActive, RequestConfigurator;
    private UpdateUserRequest $request;
    private Collection $listItems;
    private array $itemsIds = [];

    public function update(UpdateUserRequest $request): bool
    {
        try {
            $this->setRequest($request);
            DB::beginTransaction();
            $this->fetchItems();
            $this->updateEntity();
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

    private function updateEntity(): void
    {
        $this->updatedItem();
        $this->updatedOrder();
        $this->updatedAddress();
        $this->updatedPhone();
        $this->updatedUser();
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
        $this->updateModel(Pedido::class, [
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ], 'usuario_id');
    }

    private function updatedAddress(): void
    {
        $this->updateModel(Endereco::class, [
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ], 'usuario_id');
    }

    private function updatedPhone(): void
    {
        $this->updateModel(Telefone::class, [
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ], 'usuario_id');
    }

    private function updatedUser(): void
    {
        $this->updateModel(User::class, [
            'nome' => $this->request->nome,
            'email' => $this->request->email,
            'genero' => $this->request->genero,
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ], 'id');
    }

    private function updateModel(string  $model, array $data, string $column): void
    {
        $model::query()
        ->where($column, $this->request->id)
        ->update($data);
    }
}
