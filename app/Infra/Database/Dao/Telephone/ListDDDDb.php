<?php

namespace App\Infra\Database\Dao\Telephone;

use App\Infra\Database\Config\DbBase;
use Illuminate\Support\Collection;

class ListDDDDb extends DbBase
{
    public function listDDDAll(): Collection
    {
        return $this->db
        ->table('ddd')
        ->select([
            'id as dddId',
            'ddd as ddd',
            'descricao as descricao'
        ])
        ->get();
    }
}
