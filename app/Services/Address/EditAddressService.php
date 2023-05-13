<?php

namespace App\Services\Address;

use App\Http\Requests\AddressRequest;
use App\Models\Endereco;
use App\Repositories\AddressRepository;
use App\Support\Utils\Cases\AddressCase;
use DateTime;

class EditAddressService
{
    private AddressRepository $addressRepository;
    private AddressCase $addressCase;

    public function __construct(AddressRepository $addressRepository, AddressCase $addressCase)
    {
        $this->addressRepository = $addressRepository;
        $this->addressCase = $addressCase;
    }

    public function editAddress($id, AddressRequest $request): bool
    {
        $this->request = $request;
        $address = $this->mapToModel();
        return $this->addressRepository->update($id, $address);
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
        $address->usuario_id = isset($this->request->usuarioId) ? $this->request->usuarioId : null;
        $address->fornecedor_id = isset($this->request->fornecedorId) ? $this->request->fornecedorId : null;
        $address->updated_at = new DateTime();
        return $address;
    }
}
