<?php

namespace App\Services\Address\Concretes;

use App\Http\Requests\Address\CreateAddressRequest;
use App\Models\Endereco;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\CreateAddressServiceInterface;
use App\Support\Cases\AddressCase;
use App\Support\Enums\AddressEnum;

class CreateAddressService implements CreateAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(CreateAddressRequest $request): bool
    {
        $address = $this->map($request);
        return $this->addressRepository->create($address);
    }

    private function map(CreateAddressRequest $request): Endereco
    {
        $address = new Endereco();
        $address->logradouro = AddressCase::publicPlaceCase($request->logradouro);
        $address->descricao = $request->descricao;
        $address->bairro = $request->bairro;
        $address->cidade = $request->cidade;
        $address->cep = str_replace('-', "", $request->cep);
        $address->uf_id = $request->ufId;
        $address->usuario_id = $request->usuarioId ?? null;
        $address->fornecedor_id = $request->fornecedorId ?? null;
        $request = true ? $address->ativo = AddressEnum::ATIVADO : $address->ativo = AddressEnum::DESATIVADO;
        return $address;
    }
}
