<?php

namespace App\Infra\Database\Dao\Address;

use App\Infra\Database\Config\DbBase;
use Illuminate\Support\Collection;

class ListFederativeUnitDb extends DbBase
{
    public function listFederativeUnitAll(): Collection
    {
        return $this->db
        ->table('unidade_federativa')
        ->select([
            'id',
            'uf',
            'descricao'
        ])
        ->get();
    }
}
