<?php

namespace Tests\Unit\Services\Telephone;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Models\Telefone;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Concretes\CreateTelephoneService;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateTelephoneServiceTest extends TestCase
{
    private CreateTelephoneRequest $request;
    private TelephoneRepositoryInterface $telephoneRepository;
    private array $type = array('Fixo', 'Celular');

    public function test_success_create_telephone_with_params_user_id_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $this->request = new CreateTelephoneRequest();
        $this->request['telefones'] = [
            [
                'numero' => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                'tipo' => $this->type[$rand_keys],
                'dddId' => rand(1, 23),
                'cep' => rand(10000, 20000) . '-' . rand(100, 200),
                'usuarioId' => rand(1, 100),
                'ativo' => true,
            ]
        ];

        $this->telephoneRepository = $this->mock(TelephoneRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $createTelephoneService = new CreateTelephoneService($this->telephoneRepository);

        $result = $createTelephoneService->createTelephone($this->request);

        // Assert
        $this->assertTrue($result);
    }

    public function test_success_create_telephone_with_params_provider_id_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $this->request = new CreateTelephoneRequest();
        $this->request['telefones'] = [
            [
                'numero' => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                'tipo' => $this->type[$rand_keys],
                'dddId' => rand(1, 23),
                'cep' => rand(10000, 20000) . '-' . rand(100, 200),
                'fornecedorId' => rand(1, 100),
                'ativo' => true,
            ]
        ];

        $this->telephoneRepository = $this->mock(TelephoneRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $createTelephoneService = new CreateTelephoneService($this->telephoneRepository);

        $result = $createTelephoneService->createTelephone($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
