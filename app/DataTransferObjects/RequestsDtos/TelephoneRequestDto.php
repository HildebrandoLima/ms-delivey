<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\TelephoneDto;

class TelephoneRequestDto
{
    public static function fromRquest(array $telefone): TelephoneDto
    {
        $telephoneDto = new TelephoneDto();
        $telephoneDto->setNumero($telefone['numero']);
        $telephoneDto->setTipo($telefone['tipo']);
        $telephoneDto->setDddId($telefone['dddId']);
        $telephoneDto->setUsuarioId($telefone['usuarioId'] ?? null);
        $telephoneDto->setFornecedorId($telefone['fornecedorId'] ?? null);
        $telephoneDto->setAtivo($telefone['ativo']);
        return $telephoneDto;
    }
}
