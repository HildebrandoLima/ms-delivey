<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\TelephoneDto;
use App\Support\Utils\Cases\TelephoneCase;
use App\Support\Utils\Enums\TelephoneEnum;

class TelephoneRequestDto
{
    public static function fromRquest(array $telefone): TelephoneDto
    {
        $telephoneDto = new TelephoneDto();
        $type = new TelephoneCase();
        $telephoneDto->setNumero($telefone['numero']);
        $telephoneDto->setTipo($type->typeCase($telefone['tipo']));
        $telephoneDto->setDddId($telefone['dddId']);
        $telephoneDto->setUsuarioId($telefone['usuarioId'] ?? null);
        $telephoneDto->setFornecedorId($telefone['fornecedorId'] ?? null);
        $telephoneDto->setAtivo($telefone['ativo'] == 1 ? TelephoneEnum::ATIVADO : TelephoneEnum::DESATIVADO);
        return $telephoneDto;
    }
}
