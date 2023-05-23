<?php

namespace App\Services\Address;

use App\Http\Requests\AddressRequest;
use App\Models\Endereco;
use App\Repositories\AddressRepository;
use App\Services\Address\Interfaces\ICreateAddressService;
use App\Support\Utils\Cases\AddressCase;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\CheckRegister\CheckUser;

class CreateAddressService implements ICreateAddressService
{
    private CheckUser $checkUser;
    private CheckProvider $checkProvider;
    private AddressCase $addressCase;
    private AddressRepository $addressRepository;

    public function __construct
    (
        CheckUser         $checkUser,
        CheckProvider     $checkProvider,
        AddressCase       $addressCase,
        AddressRepository $addressRepository
    )
    {
        $this->checkUser         = $checkUser;
        $this->checkProvider     = $checkProvider;
        $this->addressCase       = $addressCase;
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(AddressRequest $request): int
    {
        isset ($request->usuarioId) ? $this->checkUser->checkUserIdExist($request->usuarioId)
        : $this->checkProvider->checkProviderIdExist($request->fornecedorId);
        $address = $this->mapToModel($request);
        return $this->addressRepository->insert($address);
    }

    private function mapToModel(AddressRequest $request): Endereco
    {
        $address = new Endereco();
        $address->logradouro = $this->addressCase->publicPlaceCase($request->logradouro);
        $address->descricao = $request->descricao;
        $address->bairro = $request->bairro;
        $address->cidade = $request->cidade;
        $address->cep = $request->cep;
        $address->uf_id = $request->ufId;
        $address->usuario_id = isset($request->usuarioId) ? $request->usuarioId : 1;
        $address->fornecedor_id = isset($request->fornecedorId) ? $request->fornecedorId : 1;
        return $address;
    }
}
