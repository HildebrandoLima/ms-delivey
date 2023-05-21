<?php

namespace App\Support\Utils\QueryBuilder;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Builder;

class ProductQuery {
    public function productQuery(): Builder
    {
        return Produto::query()
            ->join('fornecedor as f', 'f.id', '=', 'produto.fornecedor_id')
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
            'produto.ativo as produtoAtivo',
            'produto.created_at as produtoCriadoEm',
            'produto.updated_at as produtoAlteradoEm',
            'f.id as fornecedorId',
            'f.nome as fornecedor',
            'f.cnpj as cnpj',
            'f.email as email',
            'f.data_fundacao as dataFundacao',
            'f.ativo as fornecedorAtivo',
            'f.created_at as fornecedorCriadoEm',
            'f.updated_at as fornecedorCriadoEm'
        ]);
    }
}
