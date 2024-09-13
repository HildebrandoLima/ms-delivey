<?php

namespace App\Data\Repositories\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Domains\Dtos\ProductDto;
use App\Data\Repositories\Abstracts\IProductRepository;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Exceptions\HttpInternalServerError;
use App\Models\Produto;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Exception;

class ProductRepository extends DBConnection implements IProductRepository
{
    use AutoMapper;

    public function hasPagination(string|int $search, bool $filter): Collection
    {
        $collection = $this->query($search, 0, $filter)->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function noPagination(string|int $search, bool $filter): Collection
    {
        $collection = $this->query($search, 0, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = $this->query('', $id, $filter)->get();
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
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }

    private function query(string|int $search, int $id, bool $filter): Builder
    {
        return Produto::query()->with('imagem')
        ->where(function($query) use ($search, $id, $filter) {
            QueryFilter::getQueryFilter($query, $filter);
            if (!empty($search)):
                if (is_numeric($search)):
                    $query->where('produto.categoria_id', '=', $search);
                else:
                    $query->where('produto.nome', 'like', $search);
                endif;
            elseif (!empty($id)):
                $query->where('produto.id', '=', $id);
            else:
                QueryFilter::getQueryFilter($query, $filter);
            endif;
        })->orderByDesc('produto.id');
    }

    private function map(array $data): ProductDto
    {
        return $this->mapper($data, ProductDto::class);
    }
}
