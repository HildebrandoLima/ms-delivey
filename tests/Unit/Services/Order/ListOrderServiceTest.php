<?php

namespace Tests\Unit\Services\Order;

use App\DataTransferObjects\MappersDtos\OrderMapperDto;
use App\Models\Pedido;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Concretes\ListOrderService;
use App\Support\Utils\Enums\PerfilEnum;
use App\Support\Utils\Pagination\PaginationList;
use Mockery\MockInterface;
use Tests\TestCase;

class ListOrderServiceTest extends TestCase
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
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
        $collection = Pedido::query()->with('item')->with('pagamento')->with('usuario')
        ->where('pedido.ativo', '=', $this->active)->orderByDesc('pedido.id')
        ->whereHas('usuario', function ($query) {
            if ($this->id > 0):
                $query->where('users.id', '=', $this->id);
            else:
                $query->where('users.is_admin', '=', true);
            endif;
        })->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = OrderMapperDto::mapper($instance->toArray());
        endforeach;
        $expectedResult = PaginationList::createFromPagination($collection);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkOrderIdExist')->with($this->id);
        });

        $this->orderRepository = $this->mock(OrderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->id, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listOrderService = new ListOrderService
        (
            $this->checkEntityRepository,
            $this->orderRepository
        );

        $result = $listOrderService->listOrderAll($this->id, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray()['list']);
        $this->assertIsArray($expectedResult->toArray()['list']);
        $this->assertEquals(count($result->toArray()['list']), count($expectedResult->toArray()['list']));
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
        $this->search = '%%';
        $collect = Pedido::query()->where('pedido.ativo', '=', $this->active)
        ->where('pedido.id', '=', $this->id)
        ->orWhere('pedido.numero_pedido', 'like', $this->search)->get()->toArray()[0];
        $collection = OrderMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkOrderIdExist')->with($this->id);
        });

        $this->orderRepository = $this->mock(OrderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listOrderService = new ListOrderService
        (
            $this->checkEntityRepository,
            $this->orderRepository
        );

        $result = $listOrderService->listOrderFind($this->id, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }
}
