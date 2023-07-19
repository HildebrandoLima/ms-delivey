<?php

namespace Tests\Unit\Services\Order;

use App\Http\Requests\OrderRequest;
use App\Models\Item;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\User;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Concretes\CreateOrderService;
use App\Support\Utils\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateOrderServiceTest extends TestCase
{
    private OrderRequest $request;
    private OrderRepositoryInterface $orderRepository;
    private ItemRepositoryInterface $itemRepository;
    private int $id = 0;
    private int $count = 3;
    private float $total = 0;

    public function test_success_create_order_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $products = Produto::query()->limit($this->count)->get()->toArray();
        $data['itens'] = [];
        foreach ($products as $product):
            $item = [
                'nome' => $product['nome'],
                'preco' => $product['preco_venda'],
                'codigoBarra' => $product['codigo_barra'],
                'quantidadeItem' => $product['quantidade'],
                'subTotal' => $product['preco_venda'],
                'unidadeMedida' => $product['unidade_medida'],
                'produtoId' => $product['id'],
                'ativo' => $product['ativo'],
            ];
            $this->total += $product['preco_venda'];
            array_push($data['itens'], $item);
        endforeach;

        $this->request = new OrderRequest();
        $this->request['quantidadeItens'] = $this->count;
        $this->request['total'] = $this->total;
        $this->request['entrega'] = 3.5;
        $this->request['usuarioId'] = User::query()->first()->id;
        $this->request['ativo'] = true;
        $this->request['itens'] = $data['itens'];

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->orderRepository = $this->mock(OrderRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Pedido::class)->andReturn($this->id);
        });

        $this->itemRepository = $this->mock(ItemRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Item::class)->andReturn(true);
        });

        // Act
        $createOrderService = new CreateOrderService
        (
            $this->orderRepository,
            $this->itemRepository
        );

        $result = $createOrderService->createOrder($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
