<?php

namespace App\Services\User\Concretes;

use App\Http\Requests\User\EditUserRequest;
use App\Models\Endereco;
use App\Models\Item;
use App\Models\Pedido;
use App\Models\Telefone;
use App\Models\User;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\User\Abstracts\IEditUserService;
use App\Support\Enums\AtivoEnum;

class EditUserService implements IEditUserService
{
    private IEntityRepository $userRepository;

    public function __construct(IEntityRepository $userRepository)
    {
        $this->userRepository = $userRepository;  
    }

    public function editUser(EditUserRequest $request): bool
    {
        $listOfItemsAndOrder = $this->userRepository->read((new Item()), $request->id);
        foreach ($listOfItemsAndOrder as $instance):
            $item = $this->mapItem($instance->itemId, $request->ativo);
            $this->userRepository->update($item);
        endforeach;
        $order = $this->mapOrder($request->id, $request->ativo);
        $address = $this->mapAddress($request->id, $request->ativo);
        $telephone = $this->mapTelephone($request->id, $request->ativo);
        $user = $this->mapUser($request);
        $entitys = [$order, $address, $telephone, $user];
        foreach($entitys as $instance):
            $this->userRepository->update($instance);
        endforeach;
        return true;
    }

    public function mapItem(int $id, bool $ativo): Item
    {
        $item = new Item();
        $item->id = $id;
        $item->ativo = $ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $item;
    }

    public function mapOrder(int $id, bool $ativo): Pedido
    {
        $order = new Pedido();
        $order->usuario_id = $id;
        $order->ativo = $ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $order;
    }

    public function mapAddress(int $id, bool $ativo): Endereco
    {
        $address = new Endereco();
        $address->usuario_id = $id;
        $address->ativo = $ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $address;
    }

    public function mapTelephone(int $id, bool $ativo): Telefone
    {
        $address = new Telefone();
        $address->usuario_id = $id;
        $address->ativo = $ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $address;
    }

    private function mapUser(EditUserRequest $request): User
    {
        $user = new User();
        $user->id = $request->id;
        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->genero = $request->genero;
        return $user;
    }
}
