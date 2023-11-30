<?php

namespace App\Services\Order\Concretes;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Models\Item;
use App\Models\Pedido;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Order\Abstracts\ICreateOrderService;
use App\Support\Enums\AtivoEnum;
use App\Support\Utils\PriceFormat\PriceFormat;

class CreateOrderService implements ICreateOrderService
{
    private IEntityRepository $entityRepository;

    public function __construct(IEntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function createOrder(CreateOrderRequest $request): int
    {
        $order = $this->mapOrder($request);
        $orderId = $this->entityRepository->create($order);
        $createItem = $this->createItem($request, $orderId);
        if ($orderId and $createItem) $this->dispatchJob($order->toArray(), $request->itens);
        return $orderId;
    }

    private function mapOrder(CreateOrderRequest $request): Pedido
    {
        $order = new Pedido();
        $order->numero_pedido = random_int(100000000, 999999999);
        $order->quantidade_item = $request->quantidadeItens;
        $order->total = str_replace(',', '.', PriceFormat::priceFormart($request->total));
        $order->tipo_entrega = $request->tipoEntrega;
        $order->valor_entrega = str_replace(',', '.', PriceFormat::priceFormart($request->valorEntrega));
        $order->usuario_id = $request->usuarioId;
        $order->endereco_id = $request->enderecoId;
        $order->ativo = AtivoEnum::ATIVADO;
        return $order;
    }

    private function createItem(CreateOrderRequest $request, int $orderId): bool
    {
        foreach ($request->itens as $item):
            $items = $this->mapItem($item, $orderId);
            $this->entityRepository->create($items);
        endforeach;
        return true;
    }

    private function mapItem(array $item, int $orderId): Item
    {
        $itens = new Item();
        $itens->nome = $item['nome'];
        $itens->preco = str_replace(',', '.', PriceFormat::priceFormart($item['preco']));
        $itens->quantidade_item = $item['quantidadeItem'];
        $itens->sub_total = str_replace(',', '.', PriceFormat::priceFormart($item['subTotal']));
        $itens->pedido_id = $orderId;
        $itens->produto_id = $item['produtoId'];
        $itens->ativo = AtivoEnum::ATIVADO;
        return $itens;
    }

    private function dispatchJob(array $order, array $items): void
    {
        EmailCreateOrderJob::dispatch($order, $items);
    }
}
