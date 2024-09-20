<?php

namespace App\Data\Repositories\Order\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Order\Interfaces\ICreateOrderRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Item;
use App\Models\Pedido;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class CreateOrderRepository extends DBConnection implements ICreateOrderRepository
{
    use DefaultConditionActive;

    private Pedido $order;

    public function create(CreateOrderRequest $request): array
    {
        try {
            $this->db->beginTransaction();
            $this->createOrder($request);
            $this->createItem($request);
            $this->db->commit();
            return $this->order->toArray();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }

    public function createOrder(CreateOrderRequest $request): void
    {
        $this->order = Pedido::query()
        ->create([
            'numero_pedido' => random_int(100000000, 999999999),
            'quantidade_item' => $request->quantidadeItens,
            'total' => str_replace(',', '.', $request->total),
            'tipo_entrega' => $request->tipoEntrega,
            'valor_entrega' => $request->valorEntrega,
            'usuario_id' => $request->usuarioId,
            'endereco_id' => $request->enderecoId,
            'ativo' => $this->defaultConditionActive(true)
        ])->orderBy('id', 'desc')->first();
    }

    public function createItem(CreateOrderRequest $request): void
    {
        foreach ($request->itens as $item) {
            $this->mapItem($item);
        }
    }

    public function mapItem(array $item): void
    {
        Item::query()
        ->create([
            'nome' => $item['nome'],
            'preco' => str_replace(',', '.', $item['preco']),
            'quantidade_item' => $item['quantidadeItem'],
            'sub_total' => $item['subTotal'],
            'pedido_id' => $this->order['id'],
            'produto_id' => $item['produtoId'],
            'ativo' => $this->defaultConditionActive(true)
        ]);
    }
}
