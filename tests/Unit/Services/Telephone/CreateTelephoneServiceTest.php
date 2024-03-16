<?php

namespace Tests\Unit\Services\Telephone;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Models\Telefone;
use App\Domains\Services\Telephone\Concretes\CreateTelephoneService;
use App\Http\Requests\Telephone\CreateTelephoneRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateTelephoneServiceTest extends TestCase
{
    private CreateTelephoneRequest $request;
    private IEntityRepository $telephoneRepository;

    public function test_success_create_telephone_with_params_user_id_service(): void
    {
        // Arrange
        $createdTelephone = Telefone::query()->first();
        $this->request = new CreateTelephoneRequest([
                [
                    'ddd' => 85,
                    'numero' => $createdTelephone->numero,
                    'tipo' => $createdTelephone->tipo,
                    'usuarioId' => $createdTelephone->usuario_id,
                ]
            ]
        );

        $this->telephoneRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $createTelephoneService = new CreateTelephoneService($this->telephoneRepository);
        $result = $createTelephoneService->createTelephone($this->request);
        $mappedTelephone = $createTelephoneService->map($this->request[0]);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertEquals($this->request[0]['ddd'], 85);
        $this->assertEquals($this->request[0]['numero'], $createdTelephone->numero);
        $this->assertEquals($this->request[0]['tipo'], $createdTelephone->tipo);
        $this->assertEquals($this->request[0]['usuarioId'], $createdTelephone->usuario_id);
    }

    public function test_success_create_telephone_with_params_provider_id_service(): void
    {
        // Arrange
        $createdTelephone = Telefone::query()->first();
        $this->request = new CreateTelephoneRequest([
                [
                    'ddd' => 85,
                    'numero' => $createdTelephone->numero,
                    'tipo' => $createdTelephone->tipo,
                    'fornecedorId' => $createdTelephone->fornecedor_id,
                ]
            ]
        );

        $this->telephoneRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $createTelephoneService = new CreateTelephoneService($this->telephoneRepository);
        $result = $createTelephoneService->createTelephone($this->request);
        $mappedTelephone = $createTelephoneService->map($this->request[0]);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertEquals($this->request[0]['ddd'], 85);
        $this->assertEquals($this->request[0]['numero'], $createdTelephone->numero);
        $this->assertEquals($this->request[0]['tipo'], $createdTelephone->tipo);
        $this->assertEquals($this->request[0]['fornecedorId'], $createdTelephone->fornecedor_id);
    }
}
