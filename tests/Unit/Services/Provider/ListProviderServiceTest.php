<?php

namespace Tests\Unit\Services\User;

use App\DataTransferObjects\MappersDtos\ProviderMapperDto;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Concretes\ListProviderService;
use App\Support\Utils\Enums\PerfilEnum;
use App\Support\Utils\Pagination\PaginationList;
use Mockery\MockInterface;
use Tests\TestCase;

class ListProviderServiceTest extends TestCase
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ProviderRepositoryInterface $providerRepository;
    private int $id;
    private bool $active;
    private string $search;

    public function test_success_list_provider_all_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $collection = Fornecedor::with('endereco')->with('telefone')->where('fornecedor.ativo', '=', $this->active)
        ->orderByDesc('fornecedor.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = ProviderMapperDto::mapper($instance->toArray());
        endforeach;
        $expectedResult = PaginationList::createFromPagination($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkProviderIdExist')->with($this->id);
        });

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService
        (
            $this->checkEntityRepository,
            $this->providerRepository
        );

        $result = $listProviderService->listProviderAll($this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray()['list']);
        $this->assertIsArray($expectedResult->toArray()['list']);
        $this->assertEquals(count($result->toArray()['list']), count($expectedResult->toArray()['list']));
    }

    public function test_success_list_provider_find_id_service(): void
    {
        // Arrange
        $this->id = Fornecedor::query()->first()->id;
        $this->active = true;
        $this->search = '%%';
        $collect = Fornecedor::with('endereco')->with('telefone')
        ->where('fornecedor.ativo', '=', $this->active)->where('fornecedor.id', '=', $this->id)
        ->orWhere('fornecedor.razao_social', 'like', $this->search)->get()->toArray()[0];
        $collection = ProviderMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkProviderIdExist')->with($this->id);
        });

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService
        (
            $this->checkEntityRepository,
            $this->providerRepository
        );

        $result = $listProviderService->listProviderFind($this->id, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }

    public function test_success_list_provider_find_search_name_service(): void
    {
        // Arrange
        $this->id = 0;
        $this->active = true;
        $this->search = Fornecedor::query()->first()->razao_social;
        $collect = Fornecedor::with('endereco')->with('telefone')->where('fornecedor.ativo', '=', $this->active)
        ->where('fornecedor.id', '=', $this->id)->orWhere('fornecedor.razao_social', 'like', $this->search)->get()->toArray()[0];
        $collection = ProviderMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkProviderIdExist')->with($this->id);
        });

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService
        (
            $this->checkEntityRepository,
            $this->providerRepository
        );

        $result = $listProviderService->listProviderFind($this->id, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }
}
