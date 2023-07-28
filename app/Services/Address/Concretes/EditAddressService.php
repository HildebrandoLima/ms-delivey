<?php

namespace App\Services\Address\Concretes;

use App\Http\Requests\Address\EditAddressRequest;
use App\Models\Endereco;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\EditAddressServiceInterface;
use App\Support\Cases\AddressCase;
use App\Support\Enums\AddressEnum;

class EditAddressService implements EditAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function editAddress(EditAddressRequest $request): bool
    {
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
        $address->ativo = $request->ativo == true ? AddressEnum::ATIVADO : AddressEnum::DESATIVADO;
        return $address;
    }
}
