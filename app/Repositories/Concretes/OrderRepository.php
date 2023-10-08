<?php

namespace App\Repositories\Concretes;

use App\Dtos\OrderDto;
use App\Models\Pedido;
use App\Repositories\Abstracts\IOrderRepository;
use App\Support\MapperEntity\EntityOrder;
use App\Support\MapperEntity\EntityPerson;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\DateFormat\DateFormat;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class OrderRepository implements IOrderRepository
{
    public function readAll(string $search, int $id, bool $filter): Collection
    {
        $collection = $this->query()
        ->where(function ($query) use ($id, $search, $filter) {
            QueryFilter::getQueryFilter($query, $filter)
            ->where(function($query) use ($id, $search) {
                if (!empty($search)):
                    $query->where('pedido.numero_pedido', 'like', $search);
                else:
                    $query->where('pedido.usuario_id', '=', $id);
                endif;
            });
        })->orderByDesc('pedido.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = $this->query()
        ->where(function($query) use ($filter) {
            QueryFilter::getQueryFilter($query, $filter);
        })->where('pedido.id', '=', $id)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return collect($collection);
    }

    private function query(): Builder
    {
        return Pedido::query()->with('item')->with('pagamento')->with('endereco');
    }

    private function map(array $data): OrderDto
    {
        $order = new OrderDto();
        $order->pedidoId = $data['id'] ?? 0;
        $order->numeroPedido = $data['numero_pedido'] ?? '';
        $order->quantidadeItem = $data['quantidade_item'] ?? 0;
        $order->total = $data['total'] ?? 0;
        $order->tipoEntrega = $data['tipo_entrega'] ?? '';
        $order->valorEntrega = $data['valor_entrega'] ?? 0;
        $order->usuarioId = $data['usuario_id'] ?? 0;
        $order->ativo = $data['ativo'] ?? '';
        $order->criadoEm = DateFormat::dateFormat($data['created_at'] ?? '') ?? '';
        $order->alteradoEm = DateFormat::dateFormat($data['updated_at'] ?? '') ?? '';
        $order->itens = EntityOrder::items($data['item'] ?? []) ?? [];
        $order->pagamento = EntityOrder::payment($data['pagamento'] ?? []) ?? [];
        $order->endereco = EntityPerson::addrres($data['endereco'] ?? '') ?? [];
        return $order;
    }
}
