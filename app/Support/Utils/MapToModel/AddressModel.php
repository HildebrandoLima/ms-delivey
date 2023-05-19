<?php

namespace App\Support\Utils\MapToModel;

use App\Http\Requests\AddressRequest;
use App\Models\Endereco;
use App\Support\Utils\Cases\AddressCase;
use DateTime;

class AddressModel {
    private AddressCase $addressCase;

    public function __construct(AddressCase $addressCase)
    {
        $this->addressCase = $addressCase;
    }

    public function addressModel(AddressRequest $request, string $method): Endereco
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
        $method == 'create' ? $address->created_at = new DateTime() : $address->updated_at = new DateTime();
        return $address;
    }
}
