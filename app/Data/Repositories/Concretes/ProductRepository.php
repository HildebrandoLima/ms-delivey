<?php

namespace App\Data\Repositories\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Domains\Dtos\ProductDto;
use App\Data\Repositories\Abstracts\IProductRepository;
use App\Exceptions\BaseResponseError;
use App\Models\Produto;
use App\Support\AutoMapper\AutoMapper;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Throwable;

class ProductRepository extends DBConnection implements IProductRepository
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
        return $collection;
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

    public function delete(int $id): bool
    {
        try {
            $this->db->beginTransaction();
            $id = Produto::query()->where('id', '=', $id)->delete();
            $this->db->commit();
            return $id;
        } catch (Throwable $e) {
            $this->db->rollBack();
            throw new HttpResponseException(BaseResponseError::httpInternalServerErrorException($e));
        }
    }

    private function query(string|int $search, bool $filter): Builder
    {
        return Produto::query()->with('imagem')
        ->where(function($query) use ($search, $filter) {
            QueryFilter::getQueryFilter($query, $filter);
            if (!empty($search) and is_numeric($search)):
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
        return AutoMapper::map($data, ProductDto::class);
    }
}
