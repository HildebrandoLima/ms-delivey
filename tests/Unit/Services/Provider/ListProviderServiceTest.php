<?php

namespace Tests\Unit\Services\User;

use App\DataTransferObjects\MappersDtos\ProviderMapperDto;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Concretes\ListProviderService;
use App\Support\Enums\PerfilEnum;
use App\Support\Generate\GenerateCNPJ;
use App\Support\Generate\GenerateEmail;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListProviderServiceTest extends TestCase
{
    private ProviderRepositoryInterface $providerRepository;
    private int $id;
    private bool $active;
    private string $search;

    public function test_success_list_provider_all_service(): void
    {
        // Arrange
        $this->search = '';
        $this->active = true;

        $expectedResult = $this->paginationList();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);

        $result = $listProviderService->listProviderAll($this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_provider_all_search_service(): void
    {
        // Arrange
        $this->search = Str::random(10);
        $this->active = true;

        $expectedResult = $this->paginationList();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);

        $result = $listProviderService->listProviderAll($this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_provider_find_id_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $collect = [
            'id' => $this->id,
            'razao_social' => Str::random(10),
            'cnpj' => GenerateCNPJ::generateCNPJ(),
            'email' => GenerateEmail::generateEmail(),
            'endereco' => [],
            'telefone' => [],
            'ativo' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $collection = ProviderMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);

        $result = $listProviderService->listProviderFind($this->id, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
