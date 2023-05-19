<?php

namespace App\Support\Utils\MapToModel;

use App\Http\Requests\TelephoneRequest;
use App\Models\Telefone;
use App\Support\Utils\Cases\TelephoneCase;
use DateTime;

class TelephoneModel {
    private TelephoneCase $telephoneCase;

    public function __construct(TelephoneCase $telephoneCase)
    {
        $this->telephoneCase = $telephoneCase;
    }

    public function telephoneModel(array $telephones, string $method): Telefone
    {
        $telephone = new Telefone();
        $telephone->numero = $telephones['numero'];
        $telephone->tipo = $this->telephoneCase->typeCase($telephones['tipo']);
        $telephone->ddd_id = $telephones['dddId'];
        $telephone->usuario_id = isset ($telephones['usuarioId']) ? $telephones['usuarioId'] : 1;
        $telephone->fornecedor_id = isset ($telephones['fornecedorId']) ? $telephones['fornecedorId'] : 1;
        $method == 'create' ? $telephone->created_at = new DateTime() : $telephone->updated_at = new DateTime();
        return $telephone;
    }
}
