<?php

namespace App\Support\Utils\QueryBuilder;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Builder;

class ProviderQuery {
    public function providerQuery(): Builder
    {
        return Fornecedor::query()->select([
            'id as fornecedorId',
            'nome as nome',
            'cnpj as cnpj',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
    }
}
