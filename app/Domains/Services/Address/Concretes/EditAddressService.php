<?php

namespace App\Domains\Services\Address\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Models\Endereco;
use App\Domains\Services\Address\Abstracts\IEditAddressService;
use App\Http\Requests\Address\EditAddressRequest;
use App\Support\Enums\AtivoEnum;

class EditAddressService implements IEditAddressService
{
    private IEntityRepository $addressRepository;

    public function __construct(IEntityRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function editAddress(EditAddressRequest $request): bool
    {
        $address = $this->map($request);
        return $this->addressRepository->update($address);
    }

    public function map(EditAddressRequest $request): Endereco
    {
        $address = new Endereco();
        $address->id = $request->id;
        $address->logradouro = $request->logradouro;
        $address->numero = $request->numero;
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
