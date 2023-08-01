<?php

namespace App\Services\Address\Concretes;

use App\Http\Requests\Address\EditAddressRequest;
use App\Models\Endereco;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\EditAddressServiceInterface;
use App\Support\Enums\AtivoEnum;

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
        $address->logradouro = $request->logradouro;
        $address->descricao = $request->descricao;
        $address->bairro = $request->bairro;
        $address->cidade = $request->cidade;
        $address->cep = $request->cep;
        $address->uf = $request->uf;
        $address->usuario_id = $request->usuarioId;
        $address->fornecedor_id = $request->fornecedorId;
        $address->ativo = $request->ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $address;
    }
}
