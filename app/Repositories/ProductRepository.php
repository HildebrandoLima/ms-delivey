<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Repositories\Interfaces\IProductRepository;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductRepository implements IProductRepository {
    public function insert(Produto $produto): int
    {
        return Produto::query()->insertGetId($produto->toArray());
    }

    public function update(int $id, Produto $produto): bool
    {
        return Produto::query()->where('id', $id)->update($produto->toArray());
    }

    public function delete(int $id): bool
    {
        return Produto::query()->where('id', $id)->delete();
    }

    public function getAll(Pagination $pagination, string $search): Collection
    {
        $query = $this->mapToQuery();
        $query->orderBy('produto.id');
        if (isset ($pagination->page) && isset ($pagination->perPage)):
            return PaginationList::createFromPagination($query, $pagination);
        endif;
        return $query->where('produto.nome', 'like', $search)->get();
    }

    public function getFind(int $id): Collection
    {
        return $this->mapToQuery()->where('produto.id', $id)->get();
    }

    private function mapToQuery(): Builder
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
