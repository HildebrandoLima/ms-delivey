<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\User\Abstracts\IEditUserService;
use App\Http\Requests\User\EditUserRequest;
use App\Models\Endereco;
use App\Models\Item;
use App\Models\Pedido;
use App\Models\Telefone;
use App\Models\User;
use App\Support\Enums\ActiveEnum;

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

        foreach ($listOfItemsAndOrder as $instance):
            $order = $this->mapOrder($instance->pedidoId, $request->ativo);
            $this->userRepository->update($order);
        endforeach;

        $listAddressAndTelephone = $this->userRepository->read((new User()), $request->id);

        foreach ($listAddressAndTelephone as $instance):
            $address = $this->mapAddress($instance->enderecoId, $request->ativo);
            $this->userRepository->update($address);
        endforeach;

        foreach ($listAddressAndTelephone as $instance):
            $telephone = $this->mapTelephone($instance->telefoneId, $request->ativo);
            $this->userRepository->update($telephone);
        endforeach;

        $user = $this->mapUser($request);
        return $this->userRepository->update($user);
    }

    public function mapItem(int $id, bool $ativo): Item
    {
        $item = new Item();
        $item->id = $id;
        $item->ativo = $ativo == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO;
        return $item;
    }

    public function mapOrder(int $id, bool $ativo): Pedido
    {
        $order = new Pedido();
        $order->id = $id;
        $order->ativo = $ativo == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO;
        return $order;
    }

    public function mapAddress(int|null $id, bool $ativo): Endereco
    {
        $address = new Endereco();
        $address->id = $id;
        $address->ativo = $ativo == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO;
        return $address;
    }

    public function mapTelephone(int|null $id, bool $ativo): Telefone
    {
        $telephone = new Telefone();
        $telephone->id = $id;
        $telephone->ativo = $ativo == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO;
        return $telephone;
    }

    public function mapUser(EditUserRequest $request): User
    {
        $user = new User();
        $user->id = $request->id;
        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->genero = $request->genero;
        $user->ativo = $request->ativo == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO;
        return $user;
    }
}
