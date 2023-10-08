<?php

namespace App\Repositories\Concretes;

use App\Dtos\ProductDto;
use App\Models\Produto;
use App\Repositories\Abstracts\IProductRepository;
use App\Support\MapperEntity\EntityProduct;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\DateFormat\DateFormat;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductRepository implements IProductRepository
{
    public function readAll(Pagination $pagination, string|int $search, bool $filter): Collection
    {
        if (isset($pagination->page) && isset($pagination->perPage)):
            return $this->hasPagination($search, $filter);
        else:
            return $this->noPagination($search, $filter);
        endif;
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = Produto::query()->with('imagem')
        ->where(function($query) use ($filter) {
            QueryFilter::getQueryFilter($query, $filter);
        })->where('produto.id', '=', $id)
        ->orWhere(function ($query) use ($id) {
            $query->where('produto.categoria_id', $id);
        })->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return collect($collection);
    }

    private function hasPagination(string|int $search, bool $filter): Collection
    {
        $collection = $this->query($search, $filter)->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    private function noPagination(string|int $search, bool $filter): Collection
    {
        $collection = $this->query($search, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    private function query(string|int $search, bool $filter): Builder
    {
        return Produto::query()->with('imagem')
        ->where(function($query) use ($search, $filter) {
            QueryFilter::getQueryFilter($query, $filter);
            if (!empty($search) and is_int($search)):
                $query->where('produto.categoria_id', '=', $search);
            elseif (!empty($search) and is_string($search)):
                $query->where('produto.nome', 'like', $search);    
            else:
                QueryFilter::getQueryFilter($query, $filter);
            endif;
        })->orderByDesc('produto.id');
    }

    private function map(array $data): ProductDto
    {
        $product = new ProductDto();
        $product->produtoId = $data['id'] ?? 0;
        $product->nome = $data['nome'] ?? '';
        $product->precoCusto = $data['preco_custo'] ?? 0;
        $product->precoVenda = $data['preco_venda'] ?? 0;
        $product->margemLucro = $data['margem_lucro'] ?? 0;
        $product->codigoBarra = $data['codigo_barra'] ?? '';
        $product->descricao = $data['descricao'] ?? '';
        $product->quantidade = $data['quantidade'] ?? 0;
        $product->unidadeMedida = $data['unidade_medida'] ?? '';
        $product->dataValidade = $data['data_validade'] ?? '';
        $product->categoriaId = $data['categoria_id'] ?? 0;
        $product->fornecedorId = $data['fornecedor_id'] ?? 0;
        $product->ativo = $data['ativo'] ?? '';
        $product->criadoEm = DateFormat::dateFormat($data['created_at'] ?? '') ?? '';
        $product->alteradoEm = DateFormat::dateFormat($data['updated_at'] ?? '') ?? '';
        $product->imagens = EntityProduct::images($data['imagem'] ?? []) ?? [];
        return $product;
    }
}
