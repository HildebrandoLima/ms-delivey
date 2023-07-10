<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\Dtos\OrderDto;
use App\DataTransferObjects\MappersDtos\OrderMapperDto;
use App\Models\Pedido;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    private $query;

    public function enableDisable(int $id, int $usuarioId, int $active): bool
    {
        return Pedido::query()->where('id', $id)->orWhere('usuario_id', $usuarioId)->update(['ativo' => $active]);
    }

    public function create(OrderDto $orderDto): Pedido
    {
        return Pedido::query()->create((array)$orderDto);
    }

    public function getAll(int $id, int $active): Collection
    {
        $collection = $this->mapToQuery()->where('pedido.ativo', '=', $active)->orderByDesc('pedido.id')
        ->whereHas('usuario', function ($query) use ($id) {
            if ($id > 0):
                $query->where('users.id', '=', $id);
            else:
                $query->where('users.is_admin', '=', true);
            endif;
        })->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = OrderMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function getOne(int $id, string $search, int $active): Collection
    {
        $collect = $this->mapToQuery()->where('pedido.ativo', '=', $active)->where('pedido.id', '=', $id)
        ->orWhere('pedido.numero_pedido', 'like', $search)->get()->toArray()[0];
        $collection = OrderMapperDto::mapper($collect);
        return collect($collection);
    }

    private function mapToQuery(): Builder
    {
        return Pedido::query()->with('item')->with('pagamento')->with('usuario');
        //$this->query;
    }
}
