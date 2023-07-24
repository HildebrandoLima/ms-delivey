<?php

namespace App\Services\Address\Concretes;

use App\Http\Requests\Address\EditAddressRequest;
use App\Http\Requests\AddressRequest;
use App\Models\Endereco;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\EditAddressServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Cases\AddressCase;
use App\Support\Enums\AddressEnum;
use App\Support\Enums\PermissionEnum;

class EditAddressService extends ValidationPermission implements EditAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function editAddress(EditAddressRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_ENDERECO);
        $address = $this->map($request);
        return $this->addressRepository->update($address);
    }

    private function map(EditAddressRequest $request): Endereco
    {
        $address = new Endereco();
        $address->id = $request->id;
        $address->logradouro = AddressCase::publicPlaceCase($request->logradouro);
        $address->descricao = $request->descricao;
        $address->bairro = $request->bairro;
        $address->cidade = $request->cidade;
        $address->cep = str_replace('-', "", $request->cep);
        $address->uf_id = $request->ufId;
        $address->usuario_id = $request->usuarioId;
        $address->fornecedor_id = $request->fornecedorId;
        $request = true ? $address->ativo = AddressEnum::ATIVADO : $address->ativo = AddressEnum::DESATIVADO;
        return $address;
    }
}
