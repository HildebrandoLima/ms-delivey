<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Endereco;
use App\Models\Item;
use App\Models\Pedido;
use App\Models\Telefone;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Exception;

class UpdateUserRepository extends DBConnection implements IUpdateUserRepository
{
    use DefaultConditionActive;

    private UpdateUserRequest $request;
    private Collection $listItems;
    private array $itemsIds;

    public function update(UpdateUserRequest $request): bool
    {
        try {
            $this->request = $request;
            $this->db->beginTransaction();
            $this->queryItems();
            $this->itemsIds();
            $this->updateEntity();
            $this->db->commit();
            return true;
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

    private function updateEntity(): void
    {
        $this->updateItem();
        $this->updateOrder();
        $this->updateAddress();
        $this->updatePhone();
        $this->updateUser();
    }

    private function updateItem(): void
    {
        Item::query()
        ->whereIn('id', $this->itemsIds)
        ->update([
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }

    private function updateOrder(): void
    {
        Pedido::query()
        ->where('usuario_id', $this->request->id)
        ->update([
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }

    private function updateAddress(): void
    {
        Endereco::query()
        ->where('usuario_id', $this->request->id)
        ->update([
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }

    private function updatePhone(): void
    {
        Telefone::query()
        ->where('usuario_id', $this->request->id)
        ->update([
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }

    private function updateUser(): void
    {
        User::query()
        ->where('id', $this->request->id)
        ->update([
            'nome' => $this->request->nome,
            'email' => $this->request->email,
            'genero' => $this->request->genero,
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }
}
