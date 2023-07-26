<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\MappersDtos\OrderMapperDto;
use App\Models\Pedido;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function enableDisable(int $id, int $usuarioId, bool $active): bool
    {
        return Pedido::query()->where('id', '=', $id)->orWhere('usuario_id', $usuarioId)->update(['ativo' => $active]);
    }

    public function create(Pedido $pedido): int
    {
        return Pedido::query()->create($pedido->toArray())->orderBy('id', 'desc')->first()->id;
    }

    public function getAll(Pagination $pagination, string $search, int $id, bool $active): Collection
    {
        $collection = $this->mapToQuery()->where('pedido.ativo', '=', $active)->orderByDesc('pedido.id')
        ->whereHas('usuario', function ($query) use ($id, $search) {
            if (!empty($id)):
                $query->where('users.id', '=', $id)
                ->where(function($query) use ($search) {
                    if (!empty($search)):
                        $query->where('pedido.numero_pedido', 'like', $search);
                    endif;
                });
            else:
                $query->where('users.is_admin', '=', true)
                ->where(function($query) use ($search) {
                    if (!empty($search)):
                        $query->where('pedido.numero_pedido', 'like', $search);
                    endif;
                });
            endif;
        })->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = OrderMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function getOne(int $id, bool $active): Collection
    {
        $collect = $this->mapToQuery()->where('pedido.ativo', '=', $active)
        ->where('pedido.id', '=', $id)->get()->toArray()[0];
        $collection = OrderMapperDto::mapper($collect);
        return collect($collection);
    }

    private function mapToQuery(): Builder
    {
        return Pedido::query()->with('item')->with('pagamento')->with('usuario');
    }
}
