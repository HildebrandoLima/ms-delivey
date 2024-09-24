<?php

namespace Tests\Unit\Services\Telephone;

use App\Data\Repositories\Telephone\Interfaces\ICreateTelephoneRepository;
use App\Domains\Services\Telephone\Concretes\CreateTelephoneService;
use App\Http\Requests\Telephone\CreateTelephoneRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateTelephoneServiceTest extends TestCase
{
    private CreateTelephoneRequest $request;
    private ICreateTelephoneRepository $createTelephoneRepository;
    private array $phone = [];
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataPhone();
    }

    public function test_success_create_telephone_with_params_user_id_service(): void
    {
        // Arrange
        $this->request = new CreateTelephoneRequest($this->data);
        $this->phone = [
            'ddd' => $this->data[0]['ddd'],
            'numero' => $this->data[0]['numero'],
            'tipo' => $this->data[0]['tipo'],
            'usuarioId' => $this->data[0]['usuarioId']
        ];

        $this->createTelephoneRepository = $this->mock(ICreateTelephoneRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->withArgs(function() {
                        return
                            isset($this->phone['ddd']) &&
                            isset($this->phone['tipo']) &&
                            isset($this->phone['numero']) &&
                            isset($this->phone['usuarioId']);
                    })
                    ->andReturn(true);
        });

        // Act
        $createTelephoneService = new CreateTelephoneService($this->createTelephoneRepository);
        $result = $createTelephoneService->create($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request[0]['ddd'],  $this->data[0]['ddd']);
        $this->assertEquals($this->request[0]['numero'], $this->data[0]['numero']);
        $this->assertEquals($this->request[0]['tipo'], $this->data[0]['tipo']);
        $this->assertEquals($this->request[0]['usuarioId'], $this->data[0]['usuarioId']);
    }

    public function test_success_create_telephone_with_params_provider_id_service(): void
    {
        // Arrange
        $this->request = new CreateTelephoneRequest($this->data);
        $this->phone = [
            'ddd' => $this->data[0]['ddd'],
            'numero' => $this->data[0]['numero'],
            'tipo' => $this->data[0]['tipo'],
            'fornecedorId' => $this->data[0]['fornecedorId']
        ];

        $this->createTelephoneRepository = $this->mock(ICreateTelephoneRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->withArgs(function() {
                        return
                            isset($this->phone['ddd']) &&
                            isset($this->phone['tipo']) &&
                            isset($this->phone['numero']) &&
                            isset($this->phone['fornecedorId']);
                    })
                    ->andReturn(true);
        });

        // Act
        $createTelephoneService = new CreateTelephoneService($this->createTelephoneRepository);
        $result = $createTelephoneService->create($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request[0]['ddd'], $this->data[0]['ddd']);
        $this->assertEquals($this->request[0]['numero'], $this->data[0]['numero']);
        $this->assertEquals($this->request[0]['tipo'], $this->data[0]['tipo']);
        $this->assertEquals($this->request[0]['fornecedorId'], $this->data[0]['fornecedorId']);
    }
}
