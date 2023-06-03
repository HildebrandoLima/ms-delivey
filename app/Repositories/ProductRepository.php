<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Repositories\Interfaces\IProductRepository;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductRepository implements IProductRepository {
    public function create(Produto $produto): int
    {
        $produtoId = Produto::query()->create($produto->toArray());
        return $produtoId->id;
    }

    public function update(int $id, Produto $produto): bool
    {
        return Produto::query()->where('id', $id)->update($produto->toArray());
    }

    public function delete(int $id): bool
    {
        return Produto::query()->where('id', $id)->delete();
    }

    public function getAll(int $active): Collection
    {
        $query = $this->mapToQuery();
        $query->where('produto.ativo', $active)->orderBy('produto.id');
        return PaginationList::createFromPagination($query);
    }

    public function getFind(int $id, string $search, int $active): Collection
    {
        return $this->mapToQuery()
        ->where('produto.ativo', $active)
        ->where('produto.id', $id)
        ->orWhere('produto.nome', 'like', $search)
        ->get();
    }

    private function mapToQuery(): Builder
    {
        return Produto::query()
        ->join('categoria as c', 'c.id', '=', 'produto.categoria_id')
        ->select([
            'c.nome as categoria',
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
            'produto.updated_at as alteradoEm'
        ]);
    }
}
