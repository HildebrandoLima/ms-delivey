<?php

namespace App\Support\Utils\QueryBuilder;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Builder;

class ProductQuery {
    public function productQuery(): Builder
    {
        return Produto::query()
        ->join('categoria as c', 'c.id', '=', 'produto.categoria_id')
        ->select([
            'produto.id as produtoId',
            'produto.nome as produto',
            'produto.preco_custo as custo',
            'produto.margem_lucro as lucro',
            'produto.preco_venda as venda',
            'produto.codigo_barra as codigoBarra',
            'produto.descricao as descricao',
            'produto.quantidade as quantidade',
            'produto.unidade_medida as unidadeMedida',
            'produto.data_validade as dataValidade',
            'produto.ativo as ativo',
            'produto.created_at as criadoEm',
            'produto.updated_at as alteradoEm',
            'c.descricao as descricaoCategoria'
        ]);
    }
}
