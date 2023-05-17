<?php

namespace App\Services\Address;

use App\Http\Requests\AddressRequest;
use App\Models\Endereco;
use App\Repositories\AddressRepository;
use App\Services\Address\Interfaces\ICreateAddressService;
use App\Support\Utils\Cases\AddressCase;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\CheckRegister\CheckUser;
use DateTime;

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
        $this->request = $request;
        isset($request->usuarioId) ? $this->checkUser->checkUserIdExist($request->usuarioId)
        : $this->checkProvider->checkProviderIdExist($request->fornecedorId);
        $address = $this->mapToModel();
        return $this->addressRepository->insert($address);
    }

    private function mapToModel(): Endereco
    {
        $address = new Endereco();
        $address->logradouro = $this->addressCase->publicPlaceCase($this->request->logradouro);
        $address->descricao = $this->request->descricao;
        $address->bairro = $this->request->bairro;
        $address->cidade = $this->request->cidade;
        $address->cep = $this->request->cep;
        $address->uf_id = $this->request->ufId;
        $address->usuario_id = isset($this->request->usuarioId) ? $this->request->usuarioId : 1;
        $address->fornecedor_id = isset($this->request->fornecedorId) ? $this->request->fornecedorId : 1;
        $address->created_at = new DateTime();
        return $address;
    }
}
