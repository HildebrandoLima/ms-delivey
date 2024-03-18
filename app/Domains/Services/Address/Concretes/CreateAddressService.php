<?php

namespace App\Domains\Services\Address\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Address\Abstracts\ICreateAddressService;
use App\Http\Requests\Address\CreateAddressRequest;
use App\Models\Endereco;
use App\Support\Enums\AtivoEnum;

class CreateAddressService implements ICreateAddressService
{
    private IEntityRepository $addressRepository;

    public function __construct(IEntityRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(CreateAddressRequest $request): bool
    {
        $address = $this->map($request);
        return $this->addressRepository->create($address);
    }

    public function map(CreateAddressRequest $request): Endereco
    {
        $address = new Endereco();
        $address->logradouro = $request->logradouro;
        $address->numero = $request->numero;
        $address->bairro = $request->bairro;
        $address->cidade = $request->cidade;
        $address->cep = $request->cep;
        $address->uf = $request->uf;
        $address->usuario_id = $request->usuarioId ?? null;
        $address->fornecedor_id = $request->fornecedorId ?? null;
        $address->ativo = AtivoEnum::ATIVADO;
        return $address;
    }
}
