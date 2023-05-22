<?php

namespace App\Support\Utils\QueryBuilder;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Builder;

class ProductQuery {
    public function productQuery(): Builder
    {
        return Produto::query()
        ->select([
            'id as produtoId',
            'nome as produto',
            'preco_custo as custo',
            'margem_lucro as lucro',
            'preco_venda as venda',
            'codigo_barra as codigoBarra',
            'descricao as descricao',
            'quantidade as quantidade',
            'unidade_medida as unidadeMedida',
            'data_validade as dataValidade',
            'ativo as ativo',
            'created_at as criadoEm',
            'updated_at as alteradoEm',
        ]);
    }
}
