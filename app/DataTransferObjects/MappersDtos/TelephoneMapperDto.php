<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\TelephoneDto;

class TelephoneMapperDto
{
    public static function mapper(array $telephone): TelephoneDto
    {
        return TelephoneDto::construction()
        ->setTelefoneId($telephone['id'] ?? 0)
        ->setNumero($telephone['numero'] ?? '')
        ->setTipo($telephone['tipo'] ?? '')
        ->setDddId($telephone['ddd_id'] ?? 0)
        ->setUsuarioId($telephone['usuario_id'] ?? 0)
        ->setFornecedorId($telephone['fornecedor_id'] ?? 0)
        ->setAtivo($telephone['ativo'] ?? '')
        ->setCriadoEm($telephone['created_at'] ?? '')
        ->setAlteradoEm($telephone['updated_at'] ?? '');
    }
}
