<?php

namespace App\Services\Address;

use App\Http\Requests\AddressRequest;
use App\Models\Endereco;
use App\Repositories\AddressRepository;
use App\Services\Address\Interfaces\ICreateAddressService;
use App\Support\Utils\Cases\AddressCase;
use App\Support\Utils\Enums\AddressEnum;

class CreateAddressService implements ICreateAddressService
{
    private AddressCase $addressCase;
    private AddressRepository $addressRepository;

    public function __construct
    (
        AddressCase       $addressCase,
        AddressRepository $addressRepository
    )
    {
        $this->addressCase       = $addressCase;
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(AddressRequest $request): int
    {
        $this->request = $request;
        $address = $this->mapToModel();
        return $this->addressRepository->create($address);
    }

    private function mapToModel(): Endereco
    {
        $address = new Endereco();
        $address->logradouro = $this->addressCase->publicPlaceCase($this->request->logradouro);
        $address->descricao = $this->request->descricao;
        $address->bairro = $this->request->bairro;
        $address->cidade = $this->request->cidade;
        $address->cep = str_replace('-', "", $this->request->cep);
        $address->uf_id = $this->request->ufId;
        $address->usuario_id = $this->request->usuarioId ?? null;
        $address->fornecedor_id = $this->request->fornecedorId ?? null;
        $address->ativo = AddressEnum::ATIVADO;
        return $address;
    }
}
