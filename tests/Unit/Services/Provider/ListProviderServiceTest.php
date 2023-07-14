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

    public function test_success_list_user_all_service(): void
    {
        // Arrange
        $id = rand(1, 100);
        $active = true;
        $collection = Fornecedor::with('endereco')->with('telefone')->where('fornecedor.ativo', '=', $active)->orderByDesc('fornecedor.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = ProviderMapperDto::mapper($instance->toArray());
        endforeach;
        $expectedResult = PaginationList::createFromPagination($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkProviderIdExist')->with($id);
        });

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult, $active) {
                $mock->shouldReceive('getAll')->with($active)
                ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService
        (
            $this->checkEntityRepository,
            $this->providerRepository
        );

        $result = $listProviderService->listProviderAll($active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertEquals(count($result->toArray()['list']), count($expectedResult->toArray()['list']));
    }

    public function test_success_list_user_find_id_service(): void
    {
        // Arrange
        $id = Fornecedor::query()->first()->id;
        $active = true;
        $search = '%%';
        $collect = Fornecedor::with('endereco')->with('telefone')->where('fornecedor.ativo', '=', $active)->where('fornecedor.id', '=', $id)
        ->orWhere('fornecedor.razao_social', 'like', $search)->get()->toArray()[0];
        $collection = ProviderMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkProviderIdExist')->with($id);
        });

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult, $id, $active) {
                $mock->shouldReceive('getOne')->with($id, '', $active)
                ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService
        (
            $this->checkEntityRepository,
            $this->providerRepository
        );

        $result = $listProviderService->listProviderFind($id, '', $active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_user_find_search_name_service(): void
    {
        // Arrange
        $id = 0;
        $active = true;
        $search = Fornecedor::query()->first()->razao_social;
        $collect = Fornecedor::with('endereco')->with('telefone')->where('fornecedor.ativo', '=', $active)->where('fornecedor.id', '=', $id)
        ->orWhere('fornecedor.razao_social', 'like', $search)->get()->toArray()[0];
        $collection = ProviderMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkProviderIdExist')->with($id);
        });

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult, $id, $active) {
                $mock->shouldReceive('getOne')->with($id, '', $active)
                ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService
        (
            $this->checkEntityRepository,
            $this->providerRepository
        );

        $result = $listProviderService->listProviderFind($id, '', $active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
