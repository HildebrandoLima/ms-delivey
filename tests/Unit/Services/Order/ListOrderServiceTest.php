<?php

namespace Tests\Unit\Services\Order;

use App\DataTransferObjects\MappersDtos\OrderMapperDto;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Concretes\ListOrderService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class ListOrderServiceTest extends TestCase
{
    private OrderRepositoryInterface $orderRepository;
    private int $id;
    private bool $active;
    private string $search;

    public function test_success_list_order_all_service(): void
    {
        // Arrange
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->id = $authenticate['userId'];
        $this->active = true;
        $this->search = '';

        $expectedResult = $this->paginationList();

        $this->orderRepository = $this->mock(OrderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->search, $this->id, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listOrderService = new ListOrderService($this->orderRepository);

        $result = $listOrderService->listOrderAll($this->search, $this->id, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_order_find_service(): void
    {
        // Arrange
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->id = $authenticate['userId'];
        $this->active = true;
        $collect = [
            'id' => $this->id,
            'numero_pedido' => random_int(100000000, 999999999),
            'quantidade_items' => rand(1, 100),
            'total' => rand(1, 100),
            'entrega' => 5.39,
            'usuario_id' => rand(1, 100),
            'item' => [],
            'pagamento' => [],
            'ativo' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $collection = OrderMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $this->orderRepository = $this->mock(OrderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listOrderService = new ListOrderService($this->orderRepository);

        $result = $listOrderService->listOrderFind($this->id, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
